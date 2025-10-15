<?php

namespace App\Common\Service;

use App\Common\DTO\UserDTO;
use App\User\Repository\UserRepository;

interface UserServiceInterface
{
    public function getOrderUser(int $userId): UserDTO;
}
