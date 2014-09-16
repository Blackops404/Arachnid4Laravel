<?php namespace LRezek\Arachnid4Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class ArachnidFacade extends Facade
{

    /**
     * Get the registered name of the component
     *
     * @return string
     * @codeCoverageIgnore
     */
    protected static function getFacadeAccessor()
    {
        return 'lrezek.arachnid4laravel.arachnid';
    }
}
