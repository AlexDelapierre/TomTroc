<?php

namespace App\Model\Entity;

use App\Core\AbstractEntity;
use DateTimeImmutable;

class Message extends AbstractEntity
{
    private int $senderId;
    private int $receiverId;
    private string $content;
    private DateTimeImmutable $createdAt;

    public function __construct(array $data = [])
    {
        $this->createdAt = new DateTimeImmutable();
        parent::__construct($data);
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
}
