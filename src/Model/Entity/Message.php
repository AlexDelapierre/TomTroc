<?php

namespace App\Model\Entity;

class Message
{
    private ?int $id;
    private int $senderId;
    private int $receiverId;
    private string $content;
    private string $createdAt;

    public function __construct(
        ?int $id = null,
        int $senderId = 0,
        int $receiverId = 0,
        string $content = "",
        string $createdAt = ""
    ) {
        $this->id = $id;
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->content = $content;
        $this->createdAt = $createdAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSenderId(): int
    {
        return $this->senderId;
    }
    public function setSenderId(int $id): void
    {
        $this->senderId = $id;
    }

    public function getReceiverId(): int
    {
        return $this->receiverId;
    }
    public function setReceiverId(int $id): void
    {
        $this->receiverId = $id;
    }

    public function getContent(): string
    {
        return $this->content;
    }
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
