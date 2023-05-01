<?php

namespace LucasLeandroBR\LaravelAsaas\Services\Asaas;
namespace App\Services\Assas;

use GuzzleHttp\Client;

class AuthenticationService
{
    private $api_key;
    private $base_url;

    public function __construct()
    {
        $this->base_url = env('ASSAS_BASE_URL');
        $this->api_key = env('ASSAS_API_KEY');
    }

    protected function http(): Client
    {
        return new Client([
            'headers' => [
                'base_uri' => $this->base_url,
                'Content-Type' => 'Application/json',
                'access_token' => $this->api_key
            ]
        ]);
    }
}

