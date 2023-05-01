<?php

namespace LucasLeandroBR\LaravelAsaas;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LucasLeandroBR\LaravelAsaas\Skeleton\SkeletonClass
 */
class LaravelAsaasFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-asaas';
    }
}
