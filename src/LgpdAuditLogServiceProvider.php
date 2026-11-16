<?php

namespace JeffersonGoncalves\LgpdAuditLog;

use Illuminate\Support\Facades\Event;
use JeffersonGoncalves\Lgpd\Events\PersonalDataAnonymized;
use JeffersonGoncalves\LgpdAuditLog\Commands\VerifyCommand;
use JeffersonGoncalves\LgpdAuditLog\Listeners\LogAnonymization;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LgpdAuditLogServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('lgpd-audit-log')
            ->hasConfigFile()
            ->hasMigrations(['create_lgpd_audit_logs_table'])
            ->hasCommand(VerifyCommand::class);
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(AuditLogger::class);
    }

    public function packageBooted(): void
    {
        if (config('lgpd-audit-log.log_anonymizations', true)) {
            Event::listen(PersonalDataAnonymized::class, LogAnonymization::class);
        }
    }
}
