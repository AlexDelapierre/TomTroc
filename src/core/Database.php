<?php

namespace App\Core;

use PDO;
use PDOException;

class Database

{
    // Stocke l'instance unique de PDO
    private static $instance = null;

    /**
     * Constructeur privé pour empêcher l'instanciation directe depuis l'extérieur
     */
    private function __construct() {}

    /**
     * Empêche le clonage de l'instance
     */
    private function __clone() {}

    /**
     * Récupère l'instance unique de la connexion PDO
     * @return PDO
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            try {
                // Construction du DSN (Data Source Name)
                $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";

                self::$instance = new PDO($dsn, DB_USER, DB_PASS, [
                    // Active les exceptions pour les erreurs SQL
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    // Retourne les données sous forme de tableau associatif par défaut
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    // Désactive l'émulation des requêtes préparées (meilleure sécurité)
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                // En développement, on affiche l'erreur. En prod, on loggerait l'erreur.
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
