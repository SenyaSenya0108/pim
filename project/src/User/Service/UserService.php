<?php

namespace App\User\Service;

use App\Common\DTO\UserDTO;
use App\Common\Service\UserServiceInterface;
use App\User\Repository\UserRepository;

final readonly class UserService implements UserServiceInterface
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function getOrderUser(int $userId): UserDTO
    {
        $userData = $this->userRepository->find($userId);

        return new UserDTO()->setId($userData->getId())->setEmail($userData->getEmail());
    }
}
