<?php

namespace App\Model\Entity;

use App\Core\AbstractEntity;

class User extends AbstractEntity
{
    private string $username;
    private string $email;
    private string $password;
    private ?string $avatar;

    public function getUsername(): string
    {
        return $this->username;
    }
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }
    public function setAvatar(?string $avatar): void
    {
        $this->avatar = $avatar;
    }
}
