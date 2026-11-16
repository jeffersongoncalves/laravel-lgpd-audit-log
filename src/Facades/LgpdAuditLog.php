<?php

namespace JeffersonGoncalves\LgpdAuditLog\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JeffersonGoncalves\LgpdAuditLog\LgpdAuditLog
 */
class LgpdAuditLog extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-lgpd-audit-log';
    }
}
