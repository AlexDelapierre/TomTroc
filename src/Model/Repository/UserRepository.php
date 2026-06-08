<?php

namespace App\Model\Repository;

use App\Core\Database;
use App\Model\Entity\User;
use PDO;

/****
 * Repository pour gérer les opérations de base de données liées aux utilisateurs
 */
class UserRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Recherche un utilisateur par son ID
     * @param int $id L'ID de l'utilisateur à rechercher
     * @return User|null L'objet User si trouvé, null sinon
     */
    public function findById(int $id): ?User
    {
        $query = $this->db->prepare("SELECT * FROM user WHERE id = :id");
        $query->execute(['id' => $id]);
        $data = $query->fetch();

        return $data ? new User($data) : null;
    }

    /**
     * Recherche un utilisateur par son email
     * @param string $email L'email de l'utilisateur à rechercher
     * @return User|null L'objet User si trouvé, null sinon
     */
    public function findByEmail(string $email): ?User
    {
        $query = $this->db->prepare("SELECT * FROM user WHERE email = :email");
        $query->execute(['email' => $email]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data ? new User($data) : null;
    }

    /**
     * Ajoute un nouvel utilisateur à la base de données
     * @param User $user L'objet User à ajouter
     * @return bool True si l'ajout a réussi, false sinon
     */
    public function add(User $user): bool
    {
        $query = $this->db->prepare("
            INSERT INTO user (username, email, password, avatar, created_at)
            VALUES (:username, :email, :password, :avatar, :created_at)
        ");

        return $query->execute([
            'username'   => $user->getUsername(),
            'email'      => $user->getEmail(),
            'password'   => $user->getPassword(),
            'avatar'     => $user->getAvatar(),
            'created_at' => $user->getCreatedAt()->format('Y-m-d H:i:s')
        ]);
    }

    /**
     * Met à jour les informations d'un utilisateur dans la base de données
     * @param User $user L'objet User à mettre à jour
     * @return bool True si la mise à jour a réussi, false sinon
     */
    public function update(User $user): bool
    {
        $query = $this->db->prepare("
            UPDATE user
            SET username = :username,
                email = :email,
                password = :password,
                avatar = :avatar
            WHERE id = :id
        ");

        return $query->execute([
            'id'       => $user->getId(),
            'username' => $user->getUsername(),
            'email'    => $user->getEmail(),
            'password' => $user->getPassword(),
            'avatar'   => $user->getAvatar()
        ]);
    }

    /**
     * Supprime un utilisateur de la base de données
     * @param int $id L'ID de l'utilisateur à supprimer
     * @return bool True si la suppression a réussi, false sinon
     */
    public function delete(int $id): bool
    {
        $query = $this->db->prepare("DELETE FROM user WHERE id = :id");
        return $query->execute(['id' => $id]);
    }
}
