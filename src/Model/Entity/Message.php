<?php

namespace App\Model\Entity;

use App\Core\AbstractEntity;

class Message extends AbstractEntity
{
    private int $senderId;
    private int $receiverId;
    private string $content;
    private string $createdAt;

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
