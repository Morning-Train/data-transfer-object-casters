<?php

namespace Morningtrain\DataTransferObjectCasters\Casters;

use Spatie\DataTransferObject\Caster;

class BoolCaster implements Caster
{
    public function cast(mixed $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_BOOL);
    }
}
