<?php

namespace App\Model\Repository;

use App\Core\Database;
use App\Model\Entity\Book;
use PDO;

/**
 * Repository pour gérer les opérations de base de données liées aux livres
 */
class BookRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Ajoute un nouveau livre à la base de données
     * @param Book $book L'objet Book à ajouter
     * @return bool True si l'ajout a réussi, false sinon
     */
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

    /**
     * Met à jour les informations d'un livre existant
     * @param Book $book L'objet Book à mettre à jour
     * @return bool True si la mise à jour a réussi, false sinon
     */
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

    /**
     * Supprime un livre de la base de données
     * @param int $id L'ID du livre à supprimer
     * @return bool True si la suppression a réussi, false sinon
     */
    public function delete(int $id): bool
    {
        $query = $this->db->prepare("DELETE FROM book WHERE id = :id");
        return $query->execute(['id' => $id]);
    }

    /**
     * Recherche les livres associés à un utilisateur
     * @param int $userId L'ID de l'utilisateur
     * @return Book[] Tableau d'objets Book
     */
    public function findByUser(int $userId): array
    {
        $query = $this->db->prepare("SELECT * FROM book WHERE user_id = :user_id ORDER BY id DESC");
        $query->execute(['user_id' => $userId]);

        $books = [];
        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book($data);
        }
        return $books;
    }

    /**
     * Recherche les livres disponibles associés à un utilisateur
     * @param int $userId L'ID de l'utilisateur
     * @return Book[] Tableau d'objets Book
     */
    public function findAvailableByUser(int $userId): array
    {
        $query = $this->db->prepare("
            SELECT * FROM book
            WHERE user_id = :user_id AND is_available = 1
            ORDER BY id DESC
        ");
        $query->execute(['user_id' => $userId]);

        $books = [];
        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book($data);
        }
        return $books;
    }

    /**
     * Recherche un livre par son ID
     * @param int $id L'ID du livre à rechercher
     * @return Book|null L'objet Book si trouvé, null sinon
     */
    public function findById(int $id): ?Book
    {
        $query = $this->db->prepare("SELECT * FROM book WHERE id = :id");
        $query->execute(['id' => $id]);
        $data = $query->fetch();

        return $data ? new Book($data) : null;
    }

    /**
     * Récupère les derniers livres ajoutés
     * @param int $limit Nombre maximum de livres à récupérer
     * @return Book[] Tableau d'objets Book
     */
    public function findLatest(int $limit = 4): array
    {
        $query = $this->db->prepare("SELECT * FROM book ORDER BY id DESC LIMIT :limit");
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->execute();

        $books = [];
        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book($data);
        }
        return $books;
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
