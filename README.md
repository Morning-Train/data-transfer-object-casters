# A package containing DTO casters

[![Latest Version on Packagist](https://img.shields.io/packagist/v/morningtrain/data-transfer-object-casters.svg?style=flat-square)](https://packagist.org/packages/morningtrain/data-transfer-object-casters)
![GitHub Tests Action Status](https://github.com/Morning-Train/data-transfer-object-casters/workflows/Tests/badge.svg)
[![Code style](https://img.shields.io/github/workflow/status/Morning-Train/data-transfer-object-casters/Check%20&%20fix%20styling?label=code%20style)](https://github.com/SimonJnsson/data-transfer-object-casters/actions/workflows/php-cs-fixer.yml/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/morningtrain/data-transfer-object-casters.svg?style=flat-square)](https://packagist.org/packages/morningtrain/data-transfer-object-casters)

## Installation

You can install the package via composer:

```bash
composer require morningtrain/data-transfer-object-casters
```

## Usage

To use the provided casters, add an attribute CastWith, to the property you want to cast.

```php
class DTO extends DataTransferObject
{
    #[CastWith(BoolCaster::class)]
    public bool $bool;
}
```

### Bool

The Boolean caster is used to cast the provided value to a boolean.

It uses FILTER_VALIDATE_BOOL, see the [php docs](https://www.php.net/manual/en/filter.filters.validate.php) for more
information

### Date

The DateCaster will attempt to cast the provided value into a Carbon instance, using the provided format.

If no format is specified 'd.m.Y H:i:s' will be used.

```php
use Morningtrain\DataTransferObjectCasters\Casters\DateCaster;

class DTO extends DataTransferObject
{
    #[CastWith(DateCaster::class, format: 'Y-m-d')]
    public Carbon $date;
}
```

### Int

The IntCaster casts the provided value to an integer using (int) cast.

### Trim

The TrimCaster will trim the provided value, so no whitespace remains around the value.

### UppercaseFirst

The UppercaseFirstCaster will uppercase the first letter of the provided value, similar to
php's [ucfirst function](https://www.php.net/manual/en/function.ucfirst.php).

Optionally, the caster can lowercase the rest of the string, like so.

```php
use Morningtrain\DataTransferObjectCasters\Casters\UppercaseFirstCaster;

class DTO extends DataTransferObject
{
    #[CastWith(UppercaseFirstCaster::class, lower: true)]
    public string $ucFirstString;
}
```

If the provided value is not a string, it will return the provided value.

### Model

The ModelCaster will attempt to cast the provided value into a Model, using the given class. By default the model will
be fetched by the primary key.

```php
use Morningtrain\DataTransferObjectCasters\Casters\ModelCaster;

class DTO extends DataTransferObject
{
    #[CastWith(ModelCaster::class, model: TestModel::class)]
    public TestModel $model;
}
```

To fetch a model by a different column, use the *findBy* option.

```php
use Morningtrain\DataTransferObjectCasters\Casters\DateCaster;

class DTO extends DataTransferObject
{
    #[CastWith(ModelCaster::class, model: TestModel::class, findBy: 'name')]
    public Model $model;
}
```

If you wish to cast to a *model value* instead of the model itself, you can retrieve the value by selecting a specific
model property using the *select* option

```php
use Morningtrain\DataTransferObjectCasters\Casters\DateCaster;

class DTO extends DataTransferObject
{
    #[CastWith(ModelCaster::class, model: TestModel::class, select: 'name')]
    public string $modelName;
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [SimonJnsson](https://github.com/SimonJnsson)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
