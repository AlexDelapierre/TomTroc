<?php

namespace App;

/**
 * Autoloader pour charger automatiquement les classes de l'application
 */
class Autoloader
{
    /**
     * Enregistre l'autoloader auprès de PHP
     */
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    /**
     * Méthode d'autoload pour charger les classes en fonction de leur namespace
     * @param string $class Le nom complet de la classe à charger (avec namespace)
     */
    public static function autoload($class)
    {
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
