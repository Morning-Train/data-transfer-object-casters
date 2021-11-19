<?php

use Morningtrain\DataTransferObjectCasters\Casters\UppercaseFirstCaster;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

it('uppercases strings', function ($value, $expectedString) {
    $DTO = new class (['uppercasedString' => $value]) extends DataTransferObject {
        #[CastWith(UppercaseFirstCaster::class)]
        public ?string $uppercasedString;
    };

    expect($DTO->uppercasedString)->toBe($expectedString);
})->with([
    ['value' => 'test', 'expected' => 'Test'],
    ['value' => 'camelCase', 'expected' => 'CamelCase'],
    ['value' => 'snake_case', 'expected' => 'Snake_case'],
    ['value' => 'Uppercased', 'expected' => 'Uppercased'],
]);

it('allows lower casing the rest of the string', function ($value, $expectedString) {
    $DTO = new class (['uppercasedString' => $value]) extends DataTransferObject {
        #[CastWith(UppercaseFirstCaster::class, lower: true)]
        public ?string $uppercasedString;
    };

    expect($DTO->uppercasedString)->toBe($expectedString);
})->with([
    ['value' => 'teSt', 'expected' => 'Test'],
    ['value' => 'camelCase', 'expected' => 'Camelcase'],
    ['value' => 'snake_case', 'expected' => 'Snake_case'],
    ['value' => 'UpperCased', 'expected' => 'Uppercased'],
]);

it('does not cast non string values', function ($value, $expectedValue) {
    $DTO = new class (['uppercasedString' => $value]) extends DataTransferObject {
        #[CastWith(UppercaseFirstCaster::class)]
        public $uppercasedString;
    };

    expect($DTO->uppercasedString)->toBe($expectedValue);
})->with([
    ['value' => 123, 'expected' => 123],
    ['value' => true, 'expected' => true],
]);
