<?php

namespace Morningtrain\DataTransferObjectCasters\Casters;

use Spatie\DataTransferObject\Caster;

class IntCaster implements Caster
{
    public function cast(mixed $value): int
    {
        return (int) $value;
    }
}
