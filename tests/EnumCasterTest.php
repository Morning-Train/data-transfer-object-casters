<?php

use Morningtrain\DataTransferObjectCasters\Casters\EnumCaster;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

enum Status: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
}

it('casts to enum from backed value', function ($value, $expected) {
    $DTO = new class (['status' => $value]) extends DataTransferObject {
        #[CastWith(EnumCaster::class, Status::class)]
        public ?Status $status;
    };

    expect($DTO->status)->toBe($expected);
})->with([
    ['value' => 'draft', 'expected' => Status::DRAFT],
    ['value' => 'published', 'expected' => Status::PUBLISHED],
    ['value' => 'non-existing', 'expected' => null],
    ['value' => 1, 'expected' => null],
    ['value' => Status::DRAFT, 'expected' => Status::DRAFT],
    ['value' => Status::PUBLISHED, 'expected' => Status::PUBLISHED],
    ['value' => null, 'expected' => null],
]);
