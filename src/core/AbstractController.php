<?php

namespace App\Core;

/**
 * Contrôleur de base fournissant des méthodes communes à tous les contrôleurs
 */
abstract class AbstractController
{

    /**
     * Affiche une vue intégrée dans le layout principal
     * @param string $template Nom du fichier template (ex: 'book/list')
     * @param array $data Données à transmettre au template
     */
    protected function render(string $template, array $data = []): void
    {
        // On rend l'action courante disponible pour la navigation dynamique dans _header.php
        $data['currentAction'] = $_GET['action'] ?? 'home';

        // On récupère globablement le nombre de messages non lus pour l'injecter dans _header.php
        if (!isset($data['unreadMessagesCount'])) {
            $data['unreadMessagesCount'] = 0;
            if (isset($_SESSION['user'])) {
                $messageRepo = new \App\Model\Repository\MessageRepository();
                $data['unreadMessagesCount'] = $messageRepo->getUnreadCount($_SESSION['user']['id']);
            }
        }

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
     * Vérifie si l'utilisateur est connecté
     */
    protected function isConnected(): bool
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('index.php?action=login');
        }
        return true;
    }

    /**
     * Retourne l'ID de l'utilisateur connecté en session
     */
    protected function getSessionUserId(): ?int
    {
        return $_SESSION['user']['id'] ?? null;
    }

    /**
     * Détruit la session
     */
    protected function destroySession(): void
    {
        unset($_SESSION['user']);
        session_destroy();
    }
}
