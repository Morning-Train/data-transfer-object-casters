<?php

use Morningtrain\DataTransferObjectCasters\Casters\IntCaster;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

it('does not cast null to int', function () {
    $DTO = new class (['int' => null]) extends DataTransferObject {
        #[CastWith(IntCaster::class)]
        public ?int $int;
    };

    expect($DTO->int)->toBeNull();
});

it('casts to int', function ($numberString, $expectedInt) {
    $DTO = new class (['int' => $numberString]) extends DataTransferObject {
        #[CastWith(IntCaster::class)]
        public ?int $int;
    };

    expect($DTO->int)
        ->toBeInt()
        ->toEqual($expectedInt);
})->with([
    ['value' => '1337', 'expected' => 1337],
    ['value' => '1337.0', 'expected' => 1337],
    ['value' => '1337.5', 'expected' => 1337],
    ['value' => 1337, 'expected' => 1337],
    ['value' => true, 'expected' => 1],
    ['value' => 1337.5, 'expected' => 1337],
    ['value' => 'NaN', 'expected' => 0],
]);
