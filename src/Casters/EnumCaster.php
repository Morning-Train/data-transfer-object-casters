<?php

namespace Morningtrain\DataTransferObjectCasters\Casters;

use Spatie\DataTransferObject\Caster;

class EnumCaster implements Caster
{
    /**
     * @template T
     * @param  array  $types
     * @param  class-string<T>  $enumClass
     */
    public function __construct(array $types, public string $enumClass)
    {
    }

    public function cast(mixed $value): mixed
    {
        if($value instanceof $this->enumClass) {
            return $value;
        }

        if (! method_exists($this->enumClass, 'tryFrom')) {
            return null;
        }

        return $this->enumClass::tryFrom($value);
    }
}
