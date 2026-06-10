<?php

namespace App\Model\Entity;

use App\Core\AbstractEntity;
use App\Model\Repository\UserRepository;

/**
 * Entité représentant un livre dans l'application
 */
class Book extends AbstractEntity
{
    private int $userId;
    private string $title;
    private string $author;
    private string $description;
    private ?string $image = null;
    private bool $isAvailable = true;

    public function getUserId(): int
    {
        return $this->userId;
    }
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getIsAvailable(): bool
    {
        return $this->isAvailable;
    }
    public function setIsAvailable(bool $status): void
    {
        $this->isAvailable = $status;
    }
    public function getUser(): ?User
    {
        $userRepository = new UserRepository;
        return $userRepository->findById($this->userId);
    }
}
