<?php

/*
 * You can place your custom package configuration in here.
 */
return [

    'key' => env('STRIPE_KEY'),

    'secret' => env('STRIPE_SECRET'),

    'currency' => env('CASHIER_CURRENCY', 'brl'),

    'currency_locale' => env('CASHIER_CURRENCY_LOCALE', 'pt-BR'),

];
