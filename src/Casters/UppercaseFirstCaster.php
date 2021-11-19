<?php

namespace Morningtrain\DataTransferObjectCasters\Casters;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Spatie\DataTransferObject\Caster;

class UppercaseFirstCaster implements Caster
{
    public function __construct(array $types, public bool $lower = false)
    {
    }

    public function cast(mixed $value): mixed
    {
        if (! is_string($value)) {
            return $value;
        }

        return (string) Str::of($value)
            ->when($this->lower, fn (Stringable $string) => $string->lower())
            ->ucfirst();
    }
}
