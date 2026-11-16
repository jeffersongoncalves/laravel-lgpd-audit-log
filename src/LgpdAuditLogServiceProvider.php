<?php

namespace JeffersonGoncalves\LgpdAuditLog;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LgpdAuditLogServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-lgpd-audit-log')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations();
    }
}
