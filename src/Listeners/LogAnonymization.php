<?php

namespace JeffersonGoncalves\LgpdAuditLog\Listeners;

use JeffersonGoncalves\Lgpd\Events\PersonalDataAnonymized;
use JeffersonGoncalves\LgpdAuditLog\AuditLogger;

class LogAnonymization
{
    public function __construct(protected AuditLogger $logger) {}

    public function handle(PersonalDataAnonymized $event): void
    {
        $this->logger->record('anonymized', $event->model, $event->columns);
    }
}
