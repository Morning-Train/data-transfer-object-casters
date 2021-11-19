<?php

namespace Morningtrain\DataTransferObjectCasters\Casters;

use Carbon\Carbon;
use InvalidArgumentException;
use Morningtrain\DataTransferObjectCasters\Exceptions\InvalidDateException;
use Spatie\DataTransferObject\Caster;

class DateCaster implements Caster
{
    public function __construct(array $types, public string $format = 'd.m.Y H:i:s')
    {
    }

    /**
     * @param  mixed  $value
     * @return Carbon|mixed Carbon instance or original value
     * @throws InvalidDateException
     */
    public function cast(mixed $value): mixed
    {
        if (! is_string($value)) {
            return $value;
        }

        try {
            return Carbon::createFromFormat($this->format, $value);
        } catch (InvalidArgumentException $exception) {
            throw InvalidDateException::dateDoesNotMatchFormat($value, $this->format);
        }
    }
}
