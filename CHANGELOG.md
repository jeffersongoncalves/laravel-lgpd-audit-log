# Changelog

All notable changes to this project will be documented in this file.

## 1.0.0 - 2026-11-16

First release: LGPD audit log.

- Append-only, hash-chained log (HMAC with `lgpd.hash_key`) of who viewed, changed, exported or anonymized personal data; column names only, never values
- `AuditsPersonalData` trait: logs updates to declared columns and deletions; `auditAccess()` for reads
- Every anonymization logged through laravel-lgpd's `PersonalDataAnonymized` (DSAR erasure, retention)
- IP address and user agent kept outside the chain, so they can be anonymized
- `php artisan lgpd:audit-verify` finds altered, removed or inserted entries; pruning the oldest entries stays verifiable

## [Unreleased]
