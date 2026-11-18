<?php

namespace JeffersonGoncalves\LgpdAuditLog\Models;

use JeffersonGoncalves\Lgpd\Attributes\PersonalData;
use JeffersonGoncalves\Lgpd\Concerns\InteractsWithPersonalData;
use JeffersonGoncalves\Lgpd\Contracts\HasPersonalData;
use JeffersonGoncalves\Lgpd\Enums\LegalBasis;
use JeffersonGoncalves\Privacy\AuditLog\AuditLog as BaseAuditLog;

/**
 * One audit entry. Append-only and hash-chained: only the request columns (personal data,
 * outside the chain) may change, so an actor can still be anonymized.
 */
#[PersonalData('ip_address', purpose: 'Accountability (art. 37)', legalBasis: LegalBasis::LegalObligation)]
#[PersonalData('user_agent', purpose: 'Accountability (art. 37)', legalBasis: LegalBasis::LegalObligation)]
class AuditLog extends BaseAuditLog implements HasPersonalData
{
    use InteractsWithPersonalData;

    public function getTable(): string
    {
        return config('lgpd-audit-log.table', 'lgpd_audit_logs');
    }
}
