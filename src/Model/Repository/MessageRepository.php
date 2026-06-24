<?php

namespace App\Model\Repository;

use App\Core\Database;
use App\Model\Entity\Message;
use App\Model\Entity\User;
use PDO;

/****
 * Repository pour gérer les opérations de base de données liées aux messages
 */
class MessageRepository
{
    private PDO $db;

    /**
     * Initialise la connexion à la base de données
     */
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Ajoute un nouveau message à la base de données
     * @param Message $message L'objet Message à ajouter
     * @return bool True si l'ajout a réussi, false sinon
     */
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

    /**
     * Récupère un message par son ID
     * @param int $id L'ID du message à rechercher
     * @return Message|null L'objet Message si trouvé, null sinon
     */
    public function findById(int $id): ?Message
    {
        $query = $this->db->prepare("SELECT * FROM message WHERE id = :id");
        $query->execute(['id' => $id]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data ? new Message($data) : null;
    }

    /**
     * Récupère la liste des dernières conversations d'un utilisateur
     * @param int $userId L'ID de l'utilisateur
     * @return array Tableau de conversations
     */
    public function getLastMessagesByUser(int $userId): array
    {
        $query = $this->db->prepare("
            SELECT
                m.id, m.sender_id, m.receiver_id, m.content, m.created_at,
                s.id as sender_id_u, s.username as sender_username, s.email as sender_email, s.avatar as sender_avatar, s.created_at as sender_created_at,
                r.id as receiver_id_u, r.username as receiver_username, r.email as receiver_email, r.avatar as receiver_avatar, r.created_at as receiver_created_at
            FROM message m
            LEFT JOIN user s ON s.id = m.sender_id
            LEFT JOIN user r ON r.id = m.receiver_id
            WHERE m.sender_id = ? OR m.receiver_id = ?
            ORDER BY m.created_at DESC
        ");

        $query->execute([$userId, $userId]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $conversations = [];
        $interlocuteursVus = []; // Liste des IDs d'interlocuteurs déjà croisés, pour ignorer leurs messages plus anciens

        foreach ($results as $data) {
            // On détermine qui est l'interlocuteur en PHP
            $isSender = ($data['sender_id'] == $userId);
            $interlocuteurId = $isSender ? $data['receiver_id'] : $data['sender_id'];

            // Si on a déjà traité un message plus récent pour cet interlocuteur, on passe au suivant
            if (isset($interlocuteursVus[$interlocuteurId])) {
                continue;
            }
            $interlocuteursVus[$interlocuteurId] = true;

            // On mappe les données selon qu'on a besoin des infos de l'expéditeur ou du destinataire
            $userData = [
                'id'         => $interlocuteurId,
                'username'   => $isSender ? $data['receiver_username'] : $data['sender_username'],
                'email'      => $isSender ? $data['receiver_email'] : $data['sender_email'],
                'avatar'     => $isSender ? $data['receiver_avatar'] : $data['sender_avatar'],
                'created_at' => $isSender ? $data['receiver_created_at'] : $data['sender_created_at']
            ];
            $contact = new User($userData);

            // Extraction des données du message
            $messageData = [
                'id'          => $data['id'],
                'sender_id'   => $data['sender_id'],
                'receiver_id' => $data['receiver_id'],
                'content'     => $data['content'],
                'created_at'  => $data['created_at']
            ];
            $message = new Message($messageData);

            $conversations[] = [
                'contact' => $contact,
                'message' => $message
            ];
        }

        return $conversations;
    }

    /**
     * Récupère tous les messages entre deux utilisateurs
     * @param int $userId1 L'ID du premier utilisateur
     * @param int $userId2 L'ID du deuxième utilisateur
     * @return array Tableau d'objets Message
     */
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

    /**
     * Compte le nombre de messages non lus pour un utilisateur
     * @param int $userId L'ID de l'utilisateur
     * @return int Nombre de messages non lus
     */
    public function getUnreadCount(int $userId): int
    {
        $query = $this->db->prepare("SELECT COUNT(*) FROM message WHERE receiver_id = :receiver_id AND is_read = 0");
        $query->execute(['receiver_id' => $userId]);
        return (int) $query->fetchColumn();
    }

    /**
     * Marque les messages d'une conversation comme lus
     * @param int $receiverId L'ID du destinataire
     * @param int $senderId L'ID de l'expéditeur
     * @return bool True si la mise à jour a réussi, false sinon
     */
    public function markConversationAsRead(int $receiverId, int $senderId): bool
    {
        $query = $this->db->prepare("
            UPDATE message
            SET is_read = 1
            WHERE receiver_id = :receiver_id AND sender_id = :sender_id AND is_read = 0
        ");
        return $query->execute([
            'receiver_id' => $receiverId,
            'sender_id' => $senderId
        ]);
    }
}
