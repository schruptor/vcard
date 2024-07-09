<?php

namespace Schruptor\Vcard;

use Schruptor\Vcard\Commands\VcardCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class VcardServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('vcard')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_vcard_table')
            ->hasCommand(VcardCommand::class);
    }
}
