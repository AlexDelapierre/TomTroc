<?php

namespace App\Controller;

use App\Core\AbstractController;

/**
 * Contrôleur pour la gestion des erreurs
 */
class ErrorController extends AbstractController
{
    /**
     * Affiche la page d'erreur 404 Not Found
     */
    public function show404(): void
    {
        $this->render('errors/404', [
            'title' => 'Page non trouvée - TomTroc'
        ]);
    }
}
