<?php

class Asaas
{

    const VERSION = '3';

    const ASAAS_VERSION = '3';

    public static mixed $apiBaseUrl;

    protected static $formatCurrencyUsing;

    public static $runsMigrations = true;

    public static $registerRoutes = true;

    public static $deativatePastDue = true;

    public static $deativateIncomplete = true;

    public static $calculateTaxes = false;

    public static $customerModel = 'App\\Models\\User';

    public static $subscriptionModel = Subscription::class;

}
