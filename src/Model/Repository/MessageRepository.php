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
        $data = $query->fetch();

        if (!$data) return null;

        return new Message(
            $data['id'],
            $data['sender_id'],
            $data['receiver_id'],
            $data['content'],
            $data['created_at']
        );
    }

    public function getConversation(int $userId1, int $userId2): array
    {
        $query = $this->db->prepare("
            SELECT * FROM message
            WHERE (sender_id = :u1 AND receiver_id = :u2)
            OR (sender_id = :u2 AND receiver_id = :u1)
            ORDER BY created_at ASC
        ");
        $query->execute(['u1' => $userId1, 'u2' => $userId2]);

        $messages = [];
        while ($data = $query->fetch()) {
            $messages[] = new Message(
                $data['id'],
                $data['sender_id'],
                $data['receiver_id'],
                $data['content'],
                $data['created_at']
            );
        }
        return $messages;
    }

    public function update(Message $message): bool
    {
        $query = $this->db->prepare("UPDATE message SET content = :content WHERE id = :id");
        return $query->execute([
            'content' => $message->getContent(),
            'id'      => $message->getId()
        ]);
    }

    public function delete(int $id): bool
    {
        $query = $this->db->prepare("DELETE FROM message WHERE id = :id");
        return $query->execute(['id' => $id]);
    }

    /**
     * READ (Spécifique) : Liste des conversations avec le dernier message
     * Utile pour la page index de la messagerie.
     */
    public function getLastMessagesByUser(int $userId): array
    {
        $query = $this->db->prepare("
            SELECT m.*,
            IF(m.sender_id = :userId, m.receiver_id, m.sender_id) as contact_id
            FROM message m
            WHERE m.id IN (
                SELECT MAX(id)
                FROM message
                WHERE sender_id = :userId OR receiver_id = :userId
                GROUP BY IF(sender_id = :userId, receiver_id, sender_id)
            )
            ORDER BY m.created_at DESC
        ");

        $query->execute(['userId' => $userId]);
        return $query->fetchAll();
    }
}
