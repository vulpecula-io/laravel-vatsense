<?php

namespace Vulpecula\LaravelVatsense;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Vulpecula\LaravelVatsense\Commands\LaravelVatsenseCommand;

class LaravelVatsenseServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-vatsense')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-vatsense_table')
            ->hasCommand(LaravelVatsenseCommand::class);
    }
}
