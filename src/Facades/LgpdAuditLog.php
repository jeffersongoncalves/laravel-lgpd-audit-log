<?php

namespace JeffersonGoncalves\LgpdAuditLog\Facades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;
use JeffersonGoncalves\LgpdAuditLog\AuditLogger;
use JeffersonGoncalves\LgpdAuditLog\Models\AuditLog;

/**
 * @method static AuditLog record(string $action, ?Model $subject = null, list<string> $columns = [], ?string $purpose = null, array<string, mixed> $metadata = [], ?Model $actor = null)
 * @method static int|null verify()
 *
 * @see AuditLogger
 */
class LgpdAuditLog extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return AuditLogger::class;
    }
}
