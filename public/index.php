<?php
session_start();

require_once __DIR__ . '/../src/Autoloader.php';

\App\Autoloader::register();

use App\Core\Router;
use App\Controller\UserController;
use App\Controller\HomeController;

$router = new Router();

// Routes pour l'utilisateur
$router->addRoute('/register', UserController::class, 'register');
$router->addRoute('/login', UserController::class, 'login');
$router->addRoute('/logout', UserController::class, 'logout');

// Route par défaut (Accueil)
$router->addRoute('/', HomeController::class, 'index');

// Lancement du Router avec l'URL actuelle
try {
    $router->handleRequest($_SERVER['REQUEST_URI']);
} catch (\Throwable $e) {
    echo "<h1>Erreur technique</h1>";
    echo "<p>Message : " . $e->getMessage() . "</p>";
    echo "<p>Fichier : " . $e->getFile() . " à la ligne " . $e->getLine() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";

    // Version production : on log l'erreur et on affiche une page d'erreur générique
    // error_log($e->getMessage());
    // echo "Désolé, une erreur technique est survenue.";
    // require 'template/errors/500.php';
}
