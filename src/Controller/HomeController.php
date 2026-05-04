<?php

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\Repository\BookRepository;

class HomeController extends AbstractController
{
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
