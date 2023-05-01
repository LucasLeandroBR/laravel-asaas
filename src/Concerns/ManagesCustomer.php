<?php

namespace LucasLeandroBR\LaravelAsaas\Concerns;

use LucasLeandroBR\LaravelAsaas\Asaas;
use LucasLeandroBR\LaravelAsaas\Exceptions\CustomerAlreadyCreated;
use LucasLeandroBR\LaravelAsaas\Exceptions\InvalidCustomer;
use LucasLeandroBR\LaravelAsaas\Services\Asaas\AsaasClientService;

trait ManagesCustomer
{

    public function asaasId(): ?string
    {
        return $this->asaas_id;
    }

    public function hasAsaasId(): bool
    {
        return ! is_null($this->asaas_id);
    }

    /**
     * @throws InvalidCustomer
     */
    protected function assertCustomerExists(): void
    {
        if(!$this->hasAsaasId()) {
            throw InvalidCustomer::notYetCreated($this);
        }
    }

    /**
     * @throws CustomerAlreadyCreated
     */
    public function createAsAsaasCustomer(array $options = [])
    {
        if ($this->hasAsaasId()) {
            throw CustomerAlreadyCreated::exists($this);
        }

        if (!array_key_exists('name', $options) && $name = $this->asaasName()) {
            $options['name'] = $name;
        }

        if (!array_key_exists('email', $options) && $email = $this->asaasEmail()) {
            $options['email'] = $email;
        }

        if (!array_key_exists('cpfCnpj', $options) && $phone = $this->asaasPhone()) {
            $options['cpfCnpj'] = $phone;
        }

        $customer = (new AsaasClientService())->create($options);

        $this->asaas_id = $customer->id;

        $this->save();

        return $customer;
    }

//    public function updateStripeCustomer(array $options = [])
//    {
//        return $this->asaas()->customers->update(
//            $this->assas_id, $options
//        );
//    }

    private function asaasName()
    {
        return $this->name ?? null;
    }

    public function asaasEmail()
    {
        return $this->email ?? null;
    }

    private function asaasPhone()
    {
        return $this->phone ?? null;
    }

    public function asaasAddress()
    {
        // return [
        //     'city' => 'Little Rock',
        //     'country' => 'US',
        //     'line1' => '1 Main St.',
        //     'line2' => 'Apartment 5',
        //     'postal_code' => '72201',
        //     'state' => 'Arkansas',
        // ];
    }

    public function asaasPreferredLocales()
    {
        // return ['en'];
    }

    public function syncAsaasCustomerDetails()
    {
        return $this->updateAsaasCustomer([
            'name' => $this->asaasName(),
            'email' => $this->asaasEmail(),
            'phone' => $this->asaasPhone(),
            // 'address' => $this->asaasAddress(),
            // 'preferred_locales' => $this->asaasPreferredLocales(),
        ]);
    }

    public static function asaas(array $options = []): Asaas
    {
        return Asaas::asaas($options);
    }

}
