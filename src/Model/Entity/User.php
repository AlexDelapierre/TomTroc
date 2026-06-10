<?php

namespace App\Model\Entity;

use DateTimeImmutable;

use App\Core\AbstractEntity;

/****
 * Entité représentant un utilisateur de l'application
 */
class User extends AbstractEntity
{
    private string $username;
    private string $email;
    private string $password;
    private ?string $avatar = null;
    private DateTimeImmutable $createdAt;

    public function __construct(array $data = [])
    {
        $this->createdAt = new DateTimeImmutable();
        parent::__construct($data);
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
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
    public function setCreatedAt(string|DateTimeImmutable $createdAt): void
    {
        if (is_string($createdAt)) {
            $this->createdAt = new DateTimeImmutable($createdAt);
        } else {
            $this->createdAt = $createdAt;
        }
    }
    public function getAccountAge(): \DateInterval
    {
        $now = new DateTimeImmutable();
        return $this->createdAt->diff($now);
    }
}
