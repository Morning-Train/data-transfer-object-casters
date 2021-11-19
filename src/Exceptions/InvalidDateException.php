<?php

namespace Morningtrain\DataTransferObjectCasters\Exceptions;

use Exception;

class InvalidDateException extends Exception
{
    public static function dateDoesNotMatchFormat(string $date, string $format): static
    {
        return new static("'{$date}' does not match expected format '{$format}'");
    }
}
