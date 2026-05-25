<?php

namespace App\Exception;

class EntityNotFoundException extends \RuntimeException
{
    public static function forClass(string $class, int $id): self
    {
        return new static(sprintf('the %s with id %d was not found', $class, $id));
    }
}
