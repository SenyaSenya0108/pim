<?php

declare(strict_types=1);

namespace App\Modules\User\Service;

use App\Modules\User\DTO\UserRegistrationDTO;
use App\Modules\User\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final readonly class UserService
{
    public function __construct(
        private EntityManagerInterface      $em,
        private UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    public function getAll(): array
    {
        return $this->em->getRepository(User::class)->findAll();
    }

    public function create(UserRegistrationDTO $userDTO): void
    {
        $user = new User();
        $hashedPassword = $this->passwordHasher->hashPassword($user, $userDTO->getPassword());
        $user
            ->setEmail($userDTO->getEmail())
            ->setPassword($hashedPassword);

        $this->em->persist($user);
        $this->em->flush();
    }
}
