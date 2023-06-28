<?php

declare(strict_types=1);

namespace Swis\Elastic\Providers;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class ElasticServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Client::class, function () {
            return ClientBuilder::create()->setHosts([config('elastic.host')])->build();
        });
    }
}
