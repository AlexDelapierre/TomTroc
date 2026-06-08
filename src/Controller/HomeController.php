<?php

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\Repository\BookRepository;

/**
 * Contrôleur pour la page d'accueil
 */
class HomeController extends AbstractController
{
    /**
     * Affiche la page d'accueil avec les derniers livres ajoutés
     */
    public function index()
    {
        $bookRepository = new BookRepository();
        $books = $bookRepository->findLatest(4);

        $this->render('home', [
            'title' => 'Accueil - TomTroc',
            'books' => $books
        ]);
    }
}
