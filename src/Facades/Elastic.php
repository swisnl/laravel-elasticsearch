<?php

namespace Swis\Elastic\Facades;

use Illuminate\Support\Facades\Facade;

class Elastic extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-elastic';
    }
}
