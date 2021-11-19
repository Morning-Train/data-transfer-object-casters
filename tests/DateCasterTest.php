<?php

use Carbon\Carbon;
use Morningtrain\DataTransferObjectCasters\Casters\DateCaster;
use Morningtrain\DataTransferObjectCasters\Exceptions\InvalidDateException;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

it('casts from specified format', function () {
    $date = now();

    $dto = new class (['date' => $date->format('D M d H:i')]) extends DataTransferObject {
        #[CastWith(DateCaster::class, 'D M d H:i')]
        public Carbon $date;
    };

    expect($dto->date)->toBeInstanceOf(Carbon::class);

    expect($dto->date->format('D M d H:i'))
        ->toEqual($date->format('D M d H:i'));
});

it('throws an InvalidDateException if provided value does not match date format', function () {
    $date = Carbon::createFromDate(2021, 10, 29);

    new class (['date' => $date->format('D M d')]) extends DataTransferObject {
        #[CastWith(DateCaster::class, 'D M d H:i')]
        public Carbon $date;
    };
})->throws(InvalidDateException::class, "'Fri Oct 29' does not match expected format 'D M d H:i'");

it('does not attempt to cast non string values', function () {
    new class (['date' => 1234]) extends DataTransferObject {
        #[CastWith(DateCaster::class, 'D M d H:i')]
        public Carbon $date;
    };
})->throws(
    TypeError::class,
    'Cannot assign int to property Spatie\DataTransferObject\DataTransferObject@anonymous::$date of type Carbon\Carbon'
);

class DtoWithDateCaster extends DataTransferObject
{
    #[CastWith(DateCaster::class, 'D M d H:i')]
    public Carbon $date;
}
