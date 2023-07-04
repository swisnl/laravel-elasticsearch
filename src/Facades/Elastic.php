<?php

declare(strict_types=1);

namespace Swis\Laravel\ElasticSearch\Facades;

use Illuminate\Support\Facades\Facade;

class Elastic extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-elastic';
    }
}
