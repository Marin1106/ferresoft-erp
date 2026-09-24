<?php

namespace App\Services\Matias;

use App\Models\Log;
use App\Models\Sale;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log as Logger;
use Throwable;

class ElectronicInvoiceService
{
    public const STATUS_PENDING  = 'pendiente';
    public const STATUS_ACCEPTED = 'aceptada';
    public const STATUS_REJECTED = 'rechazada';
    public const STATUS_ERROR    = 'error';

    public function __construct(
        private MatiasClient $client
    ) {}

    /*
    |--------------------------------------------------------------------------
    | ENVIAR VENTA A LA DIAN
    |--------------------------------------------------------------------------
    | Devuelve ['ok' => bool, 'message' => string] o null si no aplica
    | (FE desactivada o venta cancelada).
    */

    public function send(Sale $sale): ?array
    {
        if (! config('matias.enabled') || $sale->status === 'Cancelada') {

            return null;

        }

        if ($sale->fe_status === self::STATUS_ACCEPTED) {

            return $this->result(true, 'La factura ' . $sale->fe_full_number . ' ya fue aceptada por la DIAN.');

        }

        $sale->loadMissing(['client', 'product']);

        /*
        |--------------------------------------------------------------------------
        | VALIDACIONES PREVIAS
        |--------------------------------------------------------------------------
        */

        if (! config('matias.resolution_number')) {

            return $this->fail($sale, 'Falta configurar MATIAS_RESOLUTION_NUMBER en el .env.');

        }

        $missing = $sale->client->missingElectronicInvoiceFields();

        if ($missing) {

            return $this->fail(
                $sale,
                'El cliente no tiene datos completos para factura electrónica: ' .
                implode(', ', $missing) . '. Complételos y reintente el envío.'
            );

        }

        /*
        |--------------------------------------------------------------------------
        | CONSECUTIVO + ENVÍO
        |--------------------------------------------------------------------------
        */

        try {

            $this->assignNumber($sale);

            $payload = $this->buildPayload($sale);

            $response = $this->client->post('invoice', $payload);

            return $this->handleResponse($sale, $response->status(), $response->json() ?? ['body' => $response->body()]);

        } catch (Throwable $e) {

            Logger::error('MATIAS API: error enviando venta #' . $sale->id, ['exception' => $e]);

            return $this->fail($sale, $e->getMessage());

        }
    }

    /*
    |--------------------------------------------------------------------------
    | CONSECUTIVO DE LA RESOLUCIÓN
    |--------------------------------------------------------------------------
    | Un número rechazado por la DIAN no se consume, por eso un reintento
    | reutiliza el número ya asignado a la venta.
    */

    private function assignNumber(Sale $sale): void
    {
        if ($sale->fe_number) {

            return;

        }

        DB::transaction(function () use ($sale) {

            $prefix = (string) config('matias.prefix');

            $last = Sale::where('fe_prefix', $prefix)
                ->lockForUpdate()
                ->max('fe_number');

            $next = max((int) $last + 1, config('matias.number_from'));

            if (config('matias.number_to') && $next > config('matias.number_to')) {

                throw new \RuntimeException(
                    'Se agotó el rango de numeración de la resolución DIAN (' .
                    config('matias.number_from') . ' - ' . config('matias.number_to') . ').'
                );

            }

            $sale->update([
                'fe_prefix' => $prefix,
                'fe_number' => $next,
                'fe_status' => self::STATUS_PENDING,
            ]);

        });
    }

    /*
    |--------------------------------------------------------------------------
    | JSON FACTURA ELECTRÓNICA (MATIAS UBL 2.1)
    |--------------------------------------------------------------------------
    */

    public function buildPayload(Sale $sale): array
    {
        $client  = $sale->client;
        $product = $sale->product;

        $now = now('America/Bogota');

        $subtotal = $this->money($sale->subtotal);
        $iva      = $this->money($sale->iva);
        $total    = $this->money($sale->total);

        $taxTotals = [[
            'tax_id'         => '1', // IVA
            'tax_amount'     => (float) $iva,
            'taxable_amount' => (float) $subtotal,
            'percent'        => config('matias.iva_percent'),
        ]];

        /*
        |--------------------------------------------------------------------------
        | FORMA DE PAGO: CONTADO / CRÉDITO
        |--------------------------------------------------------------------------
        */

        $payment = [
            'payment_method_id' => 1,
            'means_payment_id'  => config('matias.means_payment.' . $sale->payment_method, config('matias.default_means_payment')),
            'value_paid'        => $total,
        ];

        if ($sale->status === 'Pendiente') {

            $days = config('matias.credit_days');

            $payment['payment_method_id'] = 2;
            $payment['payment_due_date']  = $now->copy()->addDays($days)->format('Y-m-d');
            $payment['duration_measure']  = (string) $days;

        }

        $payload = [

            'resolution_number'      => (string) config('matias.resolution_number'),
            'document_number'        => (string) $sale->fe_number,
            'date'                   => $now->format('Y-m-d'),
            'time'                   => $now->format('H:i:s'),
            'type_document_id'       => config('matias.type_document_id'),
            'operation_type_id'      => config('matias.operation_type_id'),
            'graphic_representation' => config('matias.graphic_representation'),
            'send_email'             => config('matias.send_email'),
            'notes'                  => 'Venta FerreSoft #' . $sale->id,

            'document_signature' => [
                'cashier' => Auth::user()->name ?? config('app.name'),
                'seller'  => Auth::user()->name ?? config('app.name'),
            ],

            'customer' => array_filter([
                'country_id'           => (string) config('matias.country_id'),
                'city_id'              => (string) $client->city_id,
                'identity_document_id' => (string) $client->identity_document_id,
                'type_organization_id' => (int) $client->type_organization_id,
                'tax_regime_id'        => (int) $client->tax_regime_id,
                'tax_level_id'         => (int) $client->tax_level_id,
                'company_name'         => $client->name,
                'dni'                  => preg_replace('/\D/', '', $client->dni),
                'mobile'               => $client->phone,
                'email'                => $client->email,
                'address'              => $client->address,
                'postal_code'          => $client->postal_code,
            ], fn ($value) => filled($value)),

            'payments' => [$payment],

            'lines' => [[
                'invoiced_quantity'            => (string) $sale->quantity,
                'base_quantity'                => (string) $sale->quantity,
                'quantity_units_id'            => (string) config('matias.quantity_units_id'),
                'price_amount'                 => $this->money($sale->price),
                'line_extension_amount'        => $subtotal,
                'free_of_charge_indicator'     => false,
                'description'                  => $product->name,
                'code'                         => 'P' . str_pad($product->id, 5, '0', STR_PAD_LEFT),
                'type_item_identifications_id' => (string) config('matias.type_item_identifications_id'),
                'reference_price_id'           => (string) config('matias.reference_price_id'),
                'tax_totals'                   => $taxTotals,
            ]],

            'legal_monetary_totals' => [
                'line_extension_amount' => $subtotal,
                'tax_exclusive_amount'  => $subtotal,
                'tax_inclusive_amount'  => $total,
                'payable_amount'        => $total,
            ],

            'tax_totals' => $taxTotals,

        ];

        if (filled($sale->fe_prefix)) {

            $payload['prefix'] = $sale->fe_prefix;

        }

        return $payload;
    }

    /*
    |--------------------------------------------------------------------------
    | RESPUESTA MATIAS / DIAN
    |--------------------------------------------------------------------------
    */

    private function handleResponse(Sale $sale, int $httpStatus, array $body): array
    {
        $isValid = filter_var(Arr::get($body, 'response.IsValid'), FILTER_VALIDATE_BOOLEAN);

        if ($httpStatus < 300 && $isValid) {

            $sale->update([
                'fe_status'   => self::STATUS_ACCEPTED,
                'fe_cufe'     => $body['XmlDocumentKey'] ?? null,
                'fe_message'  => Arr::get($body, 'response.StatusMessage', $body['message'] ?? null),
                'fe_response' => json_encode($body, JSON_UNESCAPED_UNICODE),
                'fe_sent_at'  => now(),
            ]);

            $this->log($sale, 'FACTURA ELECTRÓNICA ACEPTADA', 'CUFE: ' . $sale->fe_cufe);

            return $this->result(true, 'Factura electrónica ' . $sale->fe_full_number . ' aceptada por la DIAN.');

        }

        $status = Arr::has($body, 'response.IsValid')
            ? self::STATUS_REJECTED
            : self::STATUS_ERROR;

        return $this->fail($sale, $this->errorMessage($body, $httpStatus), $status, $body);
    }

    private function errorMessage(array $body, int $httpStatus): string
    {
        $errors = Arr::flatten(array_filter([
            Arr::get($body, 'response.ErrorMessage.string'),
            Arr::get($body, 'errors'),
        ]));

        $message = Arr::get($body, 'response.StatusDescription')
            ?? $body['message']
            ?? 'Respuesta inesperada de MATIAS API (HTTP ' . $httpStatus . ').';

        return trim($message . ' ' . implode(' | ', $errors));
    }

    private function fail(Sale $sale, string $message, string $status = self::STATUS_ERROR, ?array $body = null): array
    {
        $sale->update([
            'fe_status'   => $status,
            'fe_message'  => $message,
            'fe_response' => $body ? json_encode($body, JSON_UNESCAPED_UNICODE) : $sale->fe_response,
            'fe_sent_at'  => now(),
        ]);

        $this->log($sale, 'FACTURA ELECTRÓNICA ' . strtoupper($status), $message);

        return $this->result(false, 'Factura electrónica no emitida: ' . $message);
    }

    private function log(Sale $sale, string $action, string $detail): void
    {
        Log::create([
            'action'      => $action,
            'description' => 'Venta ID #' . $sale->id . ' | ' . ($sale->fe_full_number ?? 'sin número') . ' | ' . $detail,
            'user'        => Auth::user()->name ?? 'Sistema',
        ]);
    }

    private function result(bool $ok, string $message): array
    {
        return ['ok' => $ok, 'message' => $message];
    }

    private function money($value): string
    {
        return number_format((float) $value, 2, '.', '');
    }
}
