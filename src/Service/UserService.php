<?php

namespace App\Service;

use App\DTO\RegistrationDTO;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(
        private UserPasswordHasherInterface $hasher,
        private EntityManagerInterface $em,
    ) {}

    public function register(RegistrationDTO $dto): void
    {
        $user = new User();
        $user->setFullName($dto->fullName);
        $user->setEmail($dto->email);
        $user->setPassword($this->hasher->hashPassword($user, $dto->password));
        $user->setRoles(['ROLE_USER']);

        $this->em->persist($user);
        $this->em->flush();
    }
}
