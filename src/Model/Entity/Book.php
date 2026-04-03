<?php

namespace App\Model\Entity;

class Book
{
    private ?int $id;
    private int $userId;
    private string $title;
    private string $author;
    private string $description;
    private ?string $image;
    private bool $isAvailable;

    public function __construct(?int $id = null, int $userId = 0, string $title = "", string $author = "", string $description = "", ?string $image = null, bool $isAvailable = true)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->title = $title;
        $this->author = $author;
        $this->description = $description;
        $this->image = $image;
        $this->isAvailable = $isAvailable;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

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
}
