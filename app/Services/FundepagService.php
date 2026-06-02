<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FundepagService
{
    protected string $baseUrl;
    protected string $email;
    protected string $password;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.fundepag.url', env('FUNDEPAG_API_URL', 'http://localhost:8001')), '/');
        $this->email   = config('services.fundepag.email', env('FUNDEPAG_API_EMAIL', ''));
        $this->password = config('services.fundepag.password', env('FUNDEPAG_API_PASSWORD', ''));
    }

    // ------------------------------------------------------------------
    // Auth
    // ------------------------------------------------------------------

    protected function token(): string
    {
        return Cache::remember('fundepag_api_token', 3300, function () {
            $response = Http::post("{$this->baseUrl}/api/v1/auth/login", [
                'email'    => $this->email,
                'password' => $this->password,
            ]);

            $response->throw();

            return $response->json('access_token') ?? $response->json('token');
        });
    }

    protected function client(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl)
            ->withToken($this->token())
            ->acceptJson()
            ->timeout(15);
    }

    protected function forgetToken(): void
    {
        Cache::forget('fundepag_api_token');
    }

    // ------------------------------------------------------------------
    // Institutes
    // ------------------------------------------------------------------

    /**
     * Lista institutos com paginação.
     *
     * Parâmetros aceitos: code, sigla, email, active, search, per_page, page
     */
    public function institutes(array $params = []): array
    {
        return $this->get('/api/v1/institutes', $params);
    }

    public function institute(int $id): array
    {
        return $this->get("/api/v1/institutes/{$id}");
    }

    // ------------------------------------------------------------------
    // Centers
    // ------------------------------------------------------------------

    /**
     * Lista centros com paginação.
     *
     * Parâmetros aceitos: institute_id, code, subcenter, email, active, search, per_page, page
     */
    public function centers(array $params = []): array
    {
        return $this->get('/api/v1/centers', $params);
    }

    public function center(int $id): array
    {
        return $this->get("/api/v1/centers/{$id}");
    }

    // ------------------------------------------------------------------
    // Contracts
    // ------------------------------------------------------------------

    /**
     * Lista contratos com paginação.
     *
     * Parâmetros aceitos: institute_id, institute_code, center_id, center_subcenter,
     *   code, exec_code, sub_code, type, status, coordinator, email, active,
     *   start_date_from, start_date_to, end_date_from, end_date_to, search, per_page, page
     */
    public function contracts(array $params = []): array
    {
        return $this->get('/api/v1/contracts', $params);
    }

    public function contract(int $id): array
    {
        return $this->get("/api/v1/contracts/{$id}");
    }

    // ------------------------------------------------------------------
    // Helpers internos
    // ------------------------------------------------------------------

    protected function get(string $path, array $params = []): array
    {
        // Remove params nulos/vazios para não poluir a query string
        $params = array_filter($params, fn($v) => $v !== null && $v !== '');

        try {
            $response = $this->client()->get($path, $params);

            // Token expirado? Renova e tenta uma vez
            if ($response->status() === 401) {
                $this->forgetToken();
                $response = $this->client()->get($path, $params);
            }

            $response->throw();

            return $response->json();
        } catch (\Throwable $e) {
            \Log::error("FundepagService::get {$path} failed", ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
