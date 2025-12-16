<?php

namespace App\Application\Enum;

//TODO подумать где правильнее хранить роли
enum UserRole: string
{
    case RoleAdmin = 'ROLE_ADMIN';
    case RoleUser = 'ROLE_USER';
}
