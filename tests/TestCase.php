<?php

namespace JeffersonGoncalves\LgpdAuditLog\Tests;

use JeffersonGoncalves\LgpdAuditLog\LgpdAuditLogServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            LgpdAuditLogServiceProvider::class,
        ];
    }
}
