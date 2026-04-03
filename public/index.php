<?php
session_start();

require_once 'src/Autoloader.php';

use App\Core\Router;
use App\Controller\UserController;
use App\Controller\BookController;

$router = new Router();

// Routes pour l'utilisateur
$router->addRoute('/register', UserController::class, 'register');
$router->addRoute('/login', UserController::class, 'login');
$router->addRoute('/logout', UserController::class, 'logout');

// Route par défaut (Accueil)
$router->addRoute('/', BookController::class, 'index');

// Lancement du Router avec l'URL actuelle
try {
    $router->handleRequest($_SERVER['REQUEST_URI']);
} catch (\Throwable $e) {
    error_log($e->getMessage());
    echo "Désolé, une erreur technique est survenue.";
    // require 'template/errors/500.php';
}
