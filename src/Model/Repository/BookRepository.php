<?php

namespace App\Model\Repository;

use App\Core\Database;
use App\Model\Entity\Book;
use PDO;

class BookRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function add(Book $book): bool
    {
        $query = $this->db->prepare("
            INSERT INTO book (user_id, title, author, description, image, is_available)
            VALUES (:user_id, :title, :author, :description, :image, :is_available)
        ");

        return $query->execute([
            'user_id'      => $book->getUserId(),
            'title'        => $book->getTitle(),
            'author'       => $book->getAuthor(),
            'description'  => $book->getDescription(),
            'image'        => $book->getImage(),
            'is_available' => (int)$book->getIsAvailable()
        ]);
    }

    public function update(Book $book): bool
    {
        $query = $this->db->prepare("
            UPDATE book
            SET title = :title,
                author = :author,
                description = :description,
                image = :image,
                is_available = :is_available
            WHERE id = :id
        ");

        return $query->execute([
            'id'           => $book->getId(),
            'title'        => $book->getTitle(),
            'author'       => $book->getAuthor(),
            'description'  => $book->getDescription(),
            'image'        => $book->getImage(),
            'is_available' => (int)$book->getIsAvailable()
        ]);
    }

    public function delete(int $id): bool
    {
        $query = $this->db->prepare("DELETE FROM book WHERE id = :id");
        return $query->execute(['id' => $id]);
    }

    public function findByUser(int $userId): array
    {
        $query = $this->db->prepare("SELECT * FROM book WHERE user_id = :user_id");
        $query->execute(['user_id' => $userId]);

        $books = [];
        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book($data);
        }
        return $books;
    }

    public function findById(int $id): ?Book
    {
        $query = $this->db->prepare("SELECT * FROM book WHERE id = :id");
        $query->execute(['id' => $id]);
        $data = $query->fetch();

        return $data ? new Book($data) : null;
    }

    /**
     * Récupère les livres disponibles (possibilité de filtrer par titre)
     * * @param string $search Chaîne de caractères à rechercher dans le titre
     * @return Book[] Tableau d'objets Book
     */
    public function findAvailable(string $search = ""): array
    {
        $sql = "SELECT * FROM book WHERE is_available = 1";

        $params = [];
        if (!empty($search)) {
            $sql .= " AND title LIKE :search";
            $params['search'] = '%' . $search . '%';
        }

        $query = $this->db->prepare($sql);
        $query->execute($params);

        $books = [];
        while ($data = $query->fetch()) {
            $books[] = new Book($data);
        }
        return $books;
    }
}
