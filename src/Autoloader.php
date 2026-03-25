<?php
namespace App;

class Autoloader {
    public static function register() {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($class) {
        // On retire le namespace "App\" du début (4 caractères)
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);
        // On remplace les \ par des / pour les dossiers
        $class = str_replace('\\', '/', $class);

        $file = __DIR__ . '/' . $class . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }
}
