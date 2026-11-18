# Changelog

All notable changes to this project will be documented in this file.

## 2.0.0 - 2026-11-18

### Breaking

- The engine moves to [laravel-privacy](https://github.com/jeffersongoncalves/laravel-privacy), the base shared by the LGPD, GDPR, CCPA, US privacy and Quebec suites. Every class of this package keeps its name and now extends its `JeffersonGoncalves\Privacy` base. If you extend one of them, check your overrides.

### Unchanged

- Config keys, tables, migrations, commands, events and the `#[PersonalData]` declarations: apps need no change.

### Added

- Suites installed side by side (e.g. LGPD and GDPR) only see their own declarations and events.

## 1.0.0 - 2026-11-16

First release: LGPD audit log.

- Append-only, hash-chained log (HMAC with `lgpd.hash_key`) of who viewed, changed, exported or anonymized personal data; column names only, never values
- `AuditsPersonalData` trait: logs updates to declared columns and deletions; `auditAccess()` for reads
- Every anonymization logged through laravel-lgpd's `PersonalDataAnonymized` (DSAR erasure, retention)
- IP address and user agent kept outside the chain, so they can be anonymized
- `php artisan lgpd:audit-verify` finds altered, removed or inserted entries; pruning the oldest entries stays verifiable

## [Unreleased]
