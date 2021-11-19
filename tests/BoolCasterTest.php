<?php

use Morningtrain\DataTransferObjectCasters\Casters\BoolCaster;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

/** @see https://www.php.net/manual/en/filter.filters.validate.php */
it('casts FILTER_VALIDATE_BOOL values to bool', function ($value, $expectedBoolean) {
    $DTO = new class (['bool' => $value]) extends DataTransferObject {
        #[CastWith(BoolCaster::class)]
        public bool $bool;
    };

    expect($DTO->bool)
        ->toBeBool()
        ->toEqual($expectedBoolean);
})->with([
    ['value' => '1', 'expected' => true],
    ['value' => 'true', 'expected' => true],
    ['value' => 'on', 'expected' => true],
    ['value' => 'yes', 'expected' => true],
    ['value' => 1, 'expected' => true],
    ['value' => true, 'expected' => true],

    ['value' => false, 'expected' => false],
    ['value' => 2, 'expected' => false],
    ['value' => 'no', 'expected' => false],
]);
