<?php

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\Repository\BookRepository;

class BookController extends AbstractController
{
    public function list()
    {
        $repo = new BookRepository();
        $books = $repo->findAvailable();

        // Appel de la méthode render héritée
        $this->render('book/index', [
            'title' => 'Découvrez nos livres',
            'books' => $books
        ]);
    }
}
