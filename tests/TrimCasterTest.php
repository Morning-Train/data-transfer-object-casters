<?php

use Morningtrain\DataTransferObjectCasters\Casters\TrimCaster;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

it('trims strings', function ($value, $expectedTrimmedString) {
    $DTO = new class (['trimmedString' => $value]) extends DataTransferObject {
        #[CastWith(TrimCaster::class)]
        public ?string $trimmedString;
    };

    expect($DTO->trimmedString)->toBe($expectedTrimmedString);
})->with([
    ['value' => ' Freek ', 'expected' => 'Freek'],
    ['value' => ' Taylor', 'expected' => 'Taylor'],
    ['value' => 'An entire sentence! ', 'expected' => 'An entire sentence!'],
    ['value' => '', 'expected' => ''],
    ['value' => null, 'expected' => null],
]);
