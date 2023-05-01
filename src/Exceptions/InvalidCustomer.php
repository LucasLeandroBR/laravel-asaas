<?php

class InvalidCustomer extends Exception
{

    public static function notYetCreated($owner): static
    {
        return new static(class_basename($owner).' is not a Asaas customer yet. See the createAsAsaasCustomer method.');
    }

}
