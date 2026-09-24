<?php

namespace App\Services\Matias;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class MatiasClient
{
    private const TOKEN_CACHE_KEY = 'matias.access_token';

    /*
    |--------------------------------------------------------------------------
    | POST AUTENTICADO
    |--------------------------------------------------------------------------
    | Si el token es rechazado (401) y hay email/password, se hace login
    | de nuevo y se reintenta una vez.
    */

    public function post(string $path, array $data): Response
    {
        $response = $this->request($this->token())->post($this->url($path), $data);

        if ($response->status() === 401 && $this->hasLoginCredentials()) {

            Cache::forget(self::TOKEN_CACHE_KEY);

            $response = $this->request($this->loginToken())->post($this->url($path), $data);

        }

        return $response;
    }

    private function request(string $token)
    {
        return Http::withToken($token)
            ->acceptJson()
            ->asJson()
            ->timeout(config('matias.timeout'));
    }

    private function url(string $path): string
    {
        return config('matias.url') . '/' . ltrim($path, '/');
    }

    /*
    |--------------------------------------------------------------------------
    | TOKEN
    |--------------------------------------------------------------------------
    */

    private function token(): string
    {
        if ($token = config('matias.token')) {

            return $token;

        }

        return $this->loginToken();
    }

    private function hasLoginCredentials(): bool
    {
        return filled(config('matias.email')) && filled(config('matias.password'));
    }

    private function loginToken(): string
    {
        if ($token = Cache::get(self::TOKEN_CACHE_KEY)) {

            return $token;

        }

        if (! $this->hasLoginCredentials()) {

            throw new RuntimeException(
                'Configure MATIAS_TOKEN o MATIAS_EMAIL / MATIAS_PASSWORD en el .env'
            );

        }

        $response = Http::acceptJson()
            ->timeout(config('matias.timeout'))
            ->post($this->url('auth/login'), [
                'email'       => config('matias.email'),
                'password'    => config('matias.password'),
                'remember_me' => 0,
            ]);

        $token = $response->json('access_token');

        if (! $response->successful() || ! $token) {

            throw new RuntimeException(
                'No fue posible autenticarse en MATIAS API: ' .
                ($response->json('message') ?? 'HTTP ' . $response->status())
            );

        }

        $expiresAt = $response->json('expires_at')
            ? Carbon::parse($response->json('expires_at'))->subDay()
            : now()->addDays(30);

        Cache::put(self::TOKEN_CACHE_KEY, $token, $expiresAt);

        return $token;
    }
}
