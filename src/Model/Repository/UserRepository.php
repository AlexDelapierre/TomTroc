<?php

namespace App\Repository;

use App\Core\Database;
use App\Model\Entity\User;
use PDO;

class UserRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function findById(int $id): ?User
    {
        $query = $this->db->prepare("SELECT * FROM user WHERE id = :id");
        $query->execute(['id' => $id]);
        $data = $query->fetch();

        if (!$data) return null;

        return new User(
            $data['id'],
            $data['username'],
            $data['email'],
            $data['password'],
            $data['avatar']
        );
    }

    public function findByEmail(string $email): ?User
    {
        $query = $this->db->prepare("SELECT * FROM user WHERE email = :email");
        $query->execute(['email' => $email]);
        $data = $query->fetch();

        if (!$data) return null;

        return new User(
            $data['id'],
            $data['username'],
            $data['email'],
            $data['password'],
            $data['avatar']
        );
    }

    public function add(User $user): bool
    {
        $query = $this->db->prepare("
            INSERT INTO user (username, email, password, avatar)
            VALUES (:username, :email, :password, :avatar)
        ");

        return $query->execute([
            'username' => $user->getUsername(),
            'email'    => $user->getEmail(),
            'password' => $user->getPassword(),
            'avatar'   => $user->getAvatar()
        ]);
    }

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

    public function delete(int $id): bool
    {
        $query = $this->db->prepare("DELETE FROM user WHERE id = :id");
        return $query->execute(['id' => $id]);
    }
}
