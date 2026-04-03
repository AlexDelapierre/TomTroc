<?php

namespace App\Model\Entity;

class User
{
    private ?int $id;
    private string $username;
    private string $email;
    private string $password;
    private ?string $avatar;

    public function __construct(?int $id = null, string $username = "", string $email = "", string $password = "", ?string $avatar = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->avatar = $avatar;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

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
