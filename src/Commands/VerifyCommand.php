<?php

namespace JeffersonGoncalves\LgpdAuditLog\Commands;

use Illuminate\Console\Command;
use JeffersonGoncalves\LgpdAuditLog\AuditLogger;

class VerifyCommand extends Command
{
    protected $signature = 'lgpd:audit-verify';

    protected $description = 'Check that the LGPD audit log was not altered';

    public function handle(AuditLogger $logger): int
    {
        $broken = $logger->verify();

        if ($broken !== null) {
            $this->error("The audit log chain breaks at entry #{$broken}: it or the entry before it was altered, removed or inserted.");

            return self::FAILURE;
        }

        $this->info('The audit log is intact.');

        return self::SUCCESS;
    }
}
