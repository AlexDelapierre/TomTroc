<?php

namespace App\Model\Repository;

use App\Core\Database;
use App\Model\Entity\Message;
use PDO;

class MessageRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function add(Message $message): bool
    {
        $query = $this->db->prepare("
            INSERT INTO message (sender_id, receiver_id, content)
            VALUES (:sender_id, :receiver_id, :content)
        ");

        return $query->execute([
            'sender_id'   => $message->getSenderId(),
            'receiver_id' => $message->getReceiverId(),
            'content'     => $message->getContent()
        ]);
    }

    public function findById(int $id): ?Message
    {
        $query = $this->db->prepare("SELECT * FROM message WHERE id = :id");
        $query->execute(['id' => $id]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data ? new Message($data) : null;
    }

    public function getLastMessagesByUser(int $userId): array
    {
        $query = $this->db->prepare("
            SELECT m.*,
            IF(m.sender_id = ?, m.receiver_id, m.sender_id) as contact_id
            FROM message m
            WHERE m.id IN (
                SELECT MAX(id)
                FROM message
                WHERE sender_id = ? OR receiver_id = ?
                GROUP BY IF(sender_id = ?, receiver_id, sender_id)
            )
            ORDER BY m.created_at DESC
        ");

        $query->execute([$userId, $userId, $userId, $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getConversation(int $userId1, int $userId2): array
    {
        $query = $this->db->prepare("
            SELECT * FROM message
            WHERE (sender_id = ? AND receiver_id = ?)
            OR (sender_id = ? AND receiver_id = ?)
            ORDER BY created_at ASC
        ");
        $query->execute([$userId1, $userId2, $userId2, $userId1]);

        $messages = [];
        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $messages[] = new Message($data);
        }
        return $messages;
    }
}
