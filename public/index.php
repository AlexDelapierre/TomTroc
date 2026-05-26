<?php

use App\Controller\BookController;
use App\Controller\HomeController;
use App\Controller\MessageController;
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
        case 'home':
            $homeController = new HomeController();
            $homeController->index();
            break;

        // --- Section Utilisateur / Profil ---
        case 'profile': // Mon compte (utilisateur connecté)
            $userController = new UserController();
            $userController->showProfile();
            break;

        case 'updateProfile': // Mise à jour de son profil
            $userController = new UserController();
            $userController->updateProfile();
            break;

        case 'publicProfile': // Compte d'un autre utilisateur
            $userController = new UserController();
            $userController->showPublicProfile();
            break;

        // --- Section Livres ---
        case 'books': // Liste globale
            $bookController = new BookController();
            $bookController->list();
            break;

        case 'book': // Détail d'un livre
            $bookController = new BookController();
            $bookController->show();
            break;

        case 'addBook':
            $bookController = new BookController();
            $bookController->add();
            break;

        case 'editBook':
            $bookController = new BookController();
            $bookController->edit();
            break;

        case 'deleteBook': // Supprimer un livre
            $bookController = new BookController();
            $bookController->delete();
            break;

        // --- Section Messages ---
        case 'messages':
            $messageController = new MessageController();
            $messageController->showMessages();
            break;

        // Section connexion.
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

        // Section admin.
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
