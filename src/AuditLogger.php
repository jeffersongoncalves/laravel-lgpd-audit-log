<?php

namespace JeffersonGoncalves\LgpdAuditLog;

use JeffersonGoncalves\Lgpd\Lgpd;
use JeffersonGoncalves\LgpdAuditLog\Models\AuditLog;
use JeffersonGoncalves\Privacy\AuditLog\AuditLogger as BaseAuditLogger;

/**
 * Append-only, hash-chained log of who did what to whose personal data.
 *
 * @method AuditLog record(string $action, ?\Illuminate\Database\Eloquent\Model $subject = null, list<string> $columns = [], ?string $purpose = null, array<string, mixed> $metadata = [], ?\Illuminate\Database\Eloquent\Model $actor = null)
 */
class AuditLogger extends BaseAuditLogger
{
    protected string $config = 'lgpd-audit-log';

    protected string $model = AuditLog::class;

    public function __construct(Lgpd $lgpd)
    {
        parent::__construct($lgpd);
    }
}
