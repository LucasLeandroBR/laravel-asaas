<?php

namespace LucasLeandroBR\LaravelAsaas;

use InvalidCustomer;
use Laravel\Cashier\Exceptions\CustomerAlreadyCreated;

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
    protected function assertCustomerExists()
    {
        if(!$this->hasAsaasId()) {
            throw InvalidCustomer::notYetCreated($this);
        }
    }

    /**
     * @throws CustomerAlreadyCreated
     */
    public function createAsAsaasCustomer(array $options = []): void
    {
        if ($this->hasAsaasId()) {
            throw CustomerAlreadyCreated::exists($this);
        }

        if(!array_key_exists('name', $options) && $name = $this->asaasName()) {
            $options['name'] = $name;
        }
    }

    private function asaasName()
    {
        return $this->name ?? null;
    }

}
