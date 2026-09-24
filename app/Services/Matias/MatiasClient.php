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
    | Si el token obtenido por login expiró (401), se renueva una vez.
    */

    public function post(string $path, array $data): Response
    {
        $response = $this->request()->post($this->url($path), $data);

        if ($response->status() === 401 && ! config('matias.token')) {

            Cache::forget(self::TOKEN_CACHE_KEY);

            $response = $this->request()->post($this->url($path), $data);

        }

        return $response;
    }

    private function request()
    {
        return Http::withToken($this->token())
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

        if ($token = Cache::get(self::TOKEN_CACHE_KEY)) {

            return $token;

        }

        if (! config('matias.email') || ! config('matias.password')) {

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
