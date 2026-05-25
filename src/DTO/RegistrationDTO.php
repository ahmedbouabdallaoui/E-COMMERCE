<?php

namespace App\DTO;

class RegistrationDTO
{
    public function __construct(
        public ?string $fullName = null,
        public ?string $email = null,
        public ?string $password = null,
    ) {}
}
