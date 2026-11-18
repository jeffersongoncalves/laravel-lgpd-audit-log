<?php

namespace JeffersonGoncalves\LgpdAuditLog\Commands;

use JeffersonGoncalves\LgpdAuditLog\AuditLogger;
use JeffersonGoncalves\Privacy\AuditLog\Commands\VerifyCommand as BaseVerifyCommand;

class VerifyCommand extends BaseVerifyCommand
{
    protected $signature = 'lgpd:audit-verify';

    protected $description = 'Check that the LGPD audit log was not altered';

    protected string $logger = AuditLogger::class;
}
