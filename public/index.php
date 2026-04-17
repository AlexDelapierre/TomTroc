<?php

use App\Controller\BookController;
use App\Controller\HomeController;
use App\Controller\UserController;

session_start();

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../src/Autoloader.php';

\App\Autoloader::register();

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = $_REQUEST['action'] ?? 'home';

// Try catch global pour gérer les erreurs
try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {
        // Pages accessibles à tous.
        case 'home':
            $homeController = new HomeController();
            $homeController->index();
            break;

        case 'books':
            $bookController = new BookController();
            $bookController->list();
            break;

        case 'messages':
            $bookController = new BookController();
            $bookController->list();
            break;

        // Section admin & connexion.
        case 'register':
            $userController = new UserController();
            $userController->register();
            break;

        case 'login':
            $userController = new UserController();
            $userController->login();
            break;

        case 'logout':
            $userController = new UserController();
            $userController->logout();
            break;

        // case 'admin':
        //     $adminController = new AdminController();
        //     $adminController->showAdmin();
        //     break;


        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    echo "<h1>Erreur technique</h1>";
    echo "<p>Message : " . $e->getMessage() . "</p>";
    echo "<p>Fichier : " . $e->getFile() . " à la ligne " . $e->getLine() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";

    // Version production : on log l'erreur et on affiche une page d'erreur générique
    // error_log($e->getMessage());
    // echo "Désolé, une erreur technique est survenue.";
    // require 'template/errors/500.php';
}
