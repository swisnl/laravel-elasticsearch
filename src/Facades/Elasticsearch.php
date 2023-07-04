<?php

declare(strict_types=1);

namespace Swis\Laravel\Elasticsearch\Facades;

use Illuminate\Support\Facades\Facade;

class Elasticsearch extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-elasticsearch';
    }
}
