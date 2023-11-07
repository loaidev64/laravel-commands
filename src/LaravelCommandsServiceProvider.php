<?php

namespace LoaiDev64\LaravelCommands;

use LoaiDev64\LaravelCommands\Commands\InstallRoleConfigurationCommand;
use LoaiDev64\LaravelCommands\Commands\InstallRouteConfigurationCommand;
use LoaiDev64\LaravelCommands\Commands\MakeServiceCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelCommandsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-commands')
            ->hasCommands(
                InstallRoleConfigurationCommand::class,
                InstallRouteConfigurationCommand::class,
                MakeServiceCommand::class
            );
    }
}
