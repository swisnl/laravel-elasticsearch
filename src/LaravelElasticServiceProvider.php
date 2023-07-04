<?php

declare(strict_types=1);

namespace Swis\Laravel\Elastic;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Swis\Laravel\Elastic\Commands\ElasticCreateIndex;
use Swis\Laravel\Elastic\Commands\ElasticDeleteIndex;
use Swis\Laravel\Elastic\Commands\ElasticRefreshIndex;
use Swis\Laravel\Elastic\Providers\ElasticServiceProvider;

class LaravelElasticServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('swis-elastic')
            ->hasConfigFile('elastic')
            ->hasCommands([
                ElasticRefreshIndex::class,
                ElasticCreateIndex::class,
                ElasticDeleteIndex::class,
            ])
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('swisnl/laravel-elastic');
            });
    }

    public function bootingPackage(): void
    {
        $this->app->register(ElasticServiceProvider::class);
    }
}
