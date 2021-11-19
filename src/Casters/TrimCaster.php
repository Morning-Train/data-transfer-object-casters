<?php

namespace Morningtrain\DataTransferObjectCasters\Casters;

use Illuminate\Support\Str;
use Spatie\DataTransferObject\Caster;

class TrimCaster implements Caster
{
    public function cast(mixed $value): string
    {
        return (string) Str::of($value)->trim();
    }
}
