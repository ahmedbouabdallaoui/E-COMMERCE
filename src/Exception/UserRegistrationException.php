<?php

namespace App\Exception;

class UserRegistrationException extends \RuntimeException
{
    public static function emailAlreadyExists(string $email): self
    {
        return new static(sprintf('a user with email %s is already registered', $email));
    }
}
