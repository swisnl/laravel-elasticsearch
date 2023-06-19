<?php
namespace Swis\Elastic;

use Swis\Elastic\Commands\ElasticCreateIndex;
use Swis\Elastic\Commands\ElasticDeleteIndex;
use Swis\Elastic\Commands\ElasticRefreshIndex;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Swis\Elastic\Providers\ElasticServiceProvider;

class LaravelElasticServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-elastic')
            ->hasConfigFile('elastic')
            ->hasCommands([
                ElasticRefreshIndex::class,
                ElasticCreateIndex::class,
                ElasticDeleteIndex::class,
            ])
            ->hasInstallCommand(function(InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('swisnl/laravel-elastic');
            });
    }

    public function bootingPackage()
    {
        $this->app->register(ElasticServiceProvider::class);
    }
}
