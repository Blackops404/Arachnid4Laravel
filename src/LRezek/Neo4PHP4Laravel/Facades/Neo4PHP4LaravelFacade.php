<?php namespace LRezek\Neo4PHP4Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Neo4PHP4LaravelFacade extends Facade
{

    /**
     * Get the registered name of the component
     *
     * @return string
     * @codeCoverageIgnore
     */
    protected static function getFacadeAccessor()
    {
        return 'entitymanager';
    }
}
