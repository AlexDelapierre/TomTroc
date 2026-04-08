<?php

namespace App\Controller;

use App\Core\AbstractController;

class HomeController extends AbstractController
{
    public function index()
    {
        // On pourra plus tard récupérer les 4 derniers livres ici
        $this->render('home', [
            'title' => 'Accueil - TomTroc'
        ]);
    }
}
