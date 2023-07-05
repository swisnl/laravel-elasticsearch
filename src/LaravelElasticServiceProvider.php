<?php

declare(strict_types=1);

namespace Swis\Laravel\Elasticsearch;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Swis\Laravel\Elasticsearch\Commands\ElasticsearchCreateIndex;
use Swis\Laravel\Elasticsearch\Commands\ElasticsearchDeleteIndex;
use Swis\Laravel\Elasticsearch\Commands\ElasticsearchRefreshIndex;

class LaravelElasticServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('swis-laravel-elasticsearch')
            ->hasConfigFile('elasticsearch')
            ->hasCommands([
                ElasticsearchRefreshIndex::class,
                ElasticsearchCreateIndex::class,
                ElasticsearchDeleteIndex::class,
            ])
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->askToStarRepoOnGitHub('swisnl/laravel-elasticsearch');
            });
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(Client::class, function () {
            return ClientBuilder::create()->setHosts([config('elasticsearch.host')])->build();
        });
    }
}
