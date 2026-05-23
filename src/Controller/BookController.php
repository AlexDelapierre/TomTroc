<?php

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\Entity\Book;
use App\Model\Repository\BookRepository;

class BookController extends AbstractController
{
    public function list()
    {
        $search = $_GET['search'] ?? '';

        $repo = new BookRepository();
        $books = $repo->findAvailable($search);

        $this->render('book/index', [
            'title' => 'Découvrez nos livres',
            'books' => $books,
            'search' => $search
        ]);
    }

    public function show()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            throw new \InvalidArgumentException("L'ID du livre est requis.");
        }

        $repo = new BookRepository();
        $book = $repo->findById($id);

        if (!$book) {
            throw new \InvalidArgumentException("Le livre demandé n'existe pas.");
        }

        $this->render('book/show', [
            'title' => htmlspecialchars($book->getTitle()),
            'book' => $book
        ]);
    }

    public function add()
    {
        // Vérification de la connexion
        $this->isConnected();

        $errors = [];
        $book = new Book();

        // Traitement du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $book->hydrate($_POST);
                $book->setUserId($this->getSessionUserId());

                if (empty($book->getTitle()) || empty($book->getAuthor())) {
                    $errors[] = "Le titre et l'auteur sont obligatoires.";
                }

                if (empty($errors)) {
                    $repo = new BookRepository();
                    $repo->add($book);
                    $this->redirect('index.php?action=books');
                    return;
                }
            } catch (\Exception $e) {
                $errors[] = "Une erreur est survenue lors de l'ajout.";
            }
        }

        $this->render('book/edit', [
            'title' => 'Ajouter un livre',
            'book' => $book,
            'errors' => $errors,
            'isEdit' => false
        ]);
    }

    public function edit()
    {
        // Vérification de la connexion
        $this->isConnected();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            throw new \InvalidArgumentException("L'ID du livre est requis.");
        }

        $repo = new BookRepository();
        $book = $repo->findById((int)$id);

        if (!$book || $book->getUserId() !== $this->getSessionUserId()) {
            throw new \Exception("Vous n'avez pas l'autorisation de modifier ce livre.");
        }

        $errors = [];

        // Traitement du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $book->hydrate($_POST);
                // On s'assure que le livre reste lié à son propriétaire
                $book->setUserId($this->getSessionUserId());

                if (empty($book->getTitle()) || empty($book->getAuthor())) {
                    $errors[] = "Le titre et l'auteur sont obligatoires.";
                }

                if (empty($errors)) {
                    $repo->update($book);
                    $this->redirect('index.php?action=books');
                    return;
                }
            } catch (\Exception $e) {
                $errors[] = "Une erreur est survenue lors de la modification.";
            }
        }

        $this->render('book/edit', [
            'title' => 'Modifier le livre',
            'book' => $book,
            'errors' => $errors,
            'isEdit' => true
        ]);
    }

    public function delete()
    {
        $this->isConnected();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            throw new \Exception("ID manquant.");
        }

        $repo = new BookRepository();
        $book = $repo->findById((int)$id);

        if ($book && $book->getUserId() === $this->getSessionUserId()) {
            $repo->delete((int)$id);
        } else {
            throw new \Exception("Action non autorisée.");
        }

        $this->redirect('index.php?action=books');
    }
}
