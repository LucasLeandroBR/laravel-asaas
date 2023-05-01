<?php

namespace LucasLeandroBR\LaravelAsaas\Services\Asaas;

use Error;
use Illuminate\Support\Facades\Log;

class AsaasClientService extends AuthenticationService
{

    public function create($user): mixed
    {
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'cpfCnpj' => $user->document
        ];

        $result = $this->http()->post('/customers', [
            'json' => $data,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);

        Log::info('Result', [
            'result' => json_decode($result->getBody())
        ]);

        return json_decode($result->getBody(), true);
    }

    public function find(string $clientId)
    {
        $request = $this->http()->get(`/customers/${clientId}`);

        if ($request->withStatus(200)) {
            return $request->getBody();
        }

        return throw new Error('Erro durante buscar de cliente por id');

    }

    public function update($info)
    {
        $data = [
            'name' => $info->name || '',
            'email' => $info->email || '',
            'phone' => $info->phone || '',
            'mobilePhone' => $info->mobilePhone || '',
            'cpfCnpj' => $info->cpfCnpj || '',
            'postalCode' => $info->postalCode || '',
            'address' => $info->address || '',
            'addressNumber' => $info->addressNumber || '',
            'complement' => $info->complement || '',
            'province' => $info->province || '',
            'externalReference' => $info->externalReference || '',
            'notificationDisabled' => $info->notificationDisabled || '',
            'additionalEmails' => $info->additionalEmails || '',
            'municipalInscription' => $info->municipalInscription || '',
            'stateInscription' => $info->stateInscription || '',
        ];

        $request = $this->http()->post('/customers', [
            'json' => $data
        ]);

        if ($request->withStatus(200)) {
            return $request->getBody();
        }

        return throw new Error('Erro durante atualização de cliente na Asaas');
    }

}
