<?php

declare(strict_types=1);

namespace Swis\Laravel\ElasticSearch;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Swis\Laravel\ElasticSearch\Commands\ElasticCreateIndex;
use Swis\Laravel\ElasticSearch\Commands\ElasticDeleteIndex;
use Swis\Laravel\ElasticSearch\Commands\ElasticRefreshIndex;
use Swis\Laravel\ElasticSearch\Providers\ElasticServiceProvider;

class LaravelElasticServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('swis-laravel-elasticsearch')
            ->hasConfigFile('elasticsearch')
            ->hasCommands([
                ElasticRefreshIndex::class,
                ElasticCreateIndex::class,
                ElasticDeleteIndex::class,
            ])
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->askToStarRepoOnGitHub('swisnl/laravel-elasticsearch');
            });
    }

    public function bootingPackage(): void
    {
        $this->app->register(ElasticServiceProvider::class);
    }
}
