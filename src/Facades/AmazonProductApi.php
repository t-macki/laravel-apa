<?php

namespace Macki\Facades;

use Illuminate\Support\Facades\Facade;

use Macki\AmazonProductApiClient;

class AmazonProductApi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return AmazonProductApiClient::class;
    }
}
