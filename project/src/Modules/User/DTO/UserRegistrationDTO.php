<?php

declare(strict_types=1);

namespace App\Modules\User\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class UserRegistrationDTO
{
    #[Assert\Email]
    private ?string $email = null;

    #[Assert\NotBlank]
    private ?string $password = null;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }
}
