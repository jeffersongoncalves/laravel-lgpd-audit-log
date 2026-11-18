# Laravel LGPD Audit Log

![Laravel LGPD Audit Log](https://raw.githubusercontent.com/jeffersongoncalves/laravel-lgpd-audit-log/main/art/jeffersongoncalves-laravel-lgpd-audit-log.png)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/laravel-lgpd-audit-log.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/laravel-lgpd-audit-log)
[![Tests](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/laravel-lgpd-audit-log/tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/jeffersongoncalves/laravel-lgpd-audit-log/actions/workflows/tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/laravel-lgpd-audit-log.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/laravel-lgpd-audit-log)

The Brazilian General Data Protection Law (LGPD, Lei 13.709/2018) asks controllers to keep records of their processing (art. 37) and to show the measures they take (art. 6, X). This package keeps an audit trail of who viewed, changed, exported or anonymized personal data, built on [laravel-lgpd](https://github.com/jeffersongoncalves/laravel-lgpd)'s `#[PersonalData]` declarations.

- **Column names, never values:** the log itself doesn't copy the data it protects.
- **Append-only and hash-chained:** each entry carries an HMAC of the previous one. `lgpd:audit-verify` tells you if an entry was altered, removed from the middle or inserted.
- **Automatic where Eloquent can see it:** changes to personal data columns, deletions, and every anonymization (DSAR erasure, retention).

> This package gives you tooling. It does not make you compliant on its own.

## Installation

```bash
composer require jeffersongoncalves/laravel-lgpd-audit-log
php artisan vendor:publish --tag="lgpd-audit-log-migrations"
php artisan migrate
```

Set `LGPD_HASH_KEY` (see laravel-lgpd). The chain falls back to `APP_KEY`, and rotating the key makes older entries fail verification.

## Usage

Add the trait to the models that hold personal data:

```php
use JeffersonGoncalves\LgpdAuditLog\Concerns\AuditsPersonalData;

#[PersonalData('email', anonymize: AnonymizeStrategy::Hash)]
class Customer extends Model implements HasPersonalData
{
    use AuditsPersonalData;
    use InteractsWithPersonalData;
}
```

- Updating a declared column logs `updated` with the column names. Other columns are ignored.
- Deleting the model logs `deleted`.
- `anonymizePersonalData()`, called directly, by [laravel-lgpd-dsar](https://github.com/jeffersongoncalves/laravel-lgpd-dsar) or by [laravel-lgpd-retention](https://github.com/jeffersongoncalves/laravel-lgpd-retention), logs `anonymized`. That save also logs `updated` first.

Eloquent can't tell when data is read, so log access where you show it:

```php
$customer->auditAccess('Support ticket #42');            // all declared columns
$customer->auditAccess('Billing', ['email']);

LgpdAuditLog::record('exported', $customer, ['email'], 'Answer a DSAR', ['ticket' => 42]);
```

The actor is the authenticated user unless you pass `actor:`. The IP address and user agent of the request are stored too (`store_request`). They are personal data, so they stay out of the hash chain and can be anonymized without breaking it.

### Verifying

```bash
php artisan lgpd:audit-verify
```

```php
// routes/console.php
Schedule::command('lgpd:audit-verify')->daily();
```

The oldest entry you kept is trusted as the start of the chain, so deleting old entries from the start keeps the rest verifiable. A gap in the middle does not.

## Upgrading to 2.0

2.0 runs on [laravel-privacy](https://github.com/jeffersongoncalves/laravel-privacy), the engine shared by the
LGPD, GDPR, CCPA, US privacy and Quebec suites. The classes, config keys, tables, commands and events of this package
keep their names: your code, config and data need no change. Suites installed side by side never see each other's
events. If you extend a class of this package, it now inherits from its `JeffersonGoncalves\Privacy` base.

## Testing

```bash
composer test
```

## Changelog

See [CHANGELOG](CHANGELOG.md).

## License

The MIT License (MIT). See [License File](LICENSE.md).
