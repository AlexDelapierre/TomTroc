<?php

namespace App\Core;

abstract class AbstractController
{

    /**
     * Affiche une vue intégrée dans le layout principal
     * @param string $view Nom du fichier vue (ex: 'book/list')
     * @param array $data Données à transmettre à la vue
     */
    protected function render(string $template, array $data = []): void
    {
        extract($data);

        ob_start();

        $templatePath = __DIR__ . '/../../templates/' . $template . '.php';
        if (file_exists($templatePath)) {
            require $templatePath;
        } else {
            die("Erreur : Le template '{$template}' est introuvable.");
        }

        $content = ob_get_clean();

        require __DIR__ . '/../../templates/layout.php';
    }

    /**
     * Redirige vers une autre page
     */
    protected function redirect(string $url): void
    {
        header("Location: " . $url);
        exit();
    }

    /**
     * Connecte un utilisateur en enregistrant ses infos en session
     */
    protected function setUserSession($user): void
    {
        $_SESSION['user'] = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'avatar' => $user->getAvatar()
        ];
    }

    /**
     * Déconnecte l'utilisateur
     */
    protected function logout(): void
    {
        unset($_SESSION['user']);
        session_destroy();
    }

    /**
     * Vérifie si l'utilisateur est connecté
     */
    protected function isConnected(): bool
    {
        return isset($_SESSION['user']);
    }
}
