<?php

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\Repository\MessageRepository;
use App\Model\Repository\UserRepository;
use App\Model\Entity\Message;

/**
 * Contrôleur pour la gestion des messages
 */
class MessageController extends AbstractController
{
    /**
     * Affiche la liste des conversations de l'utilisateur connecté et les messages d'une conversation sélectionnée
     */
    public function showMessages()
    {
        $this->isConnected();
        $userId = $this->getSessionUserId();

        // Génération d'un token CSRF sécurisé s'il n'existe pas en session
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $messageRepo = new MessageRepository();
        $userRepo = new UserRepository();

        $conversations = $messageRepo->getLastMessagesByUser($userId);
        $contact = null;
        $messages = [];

        // Récupération de l'ID via l'URL
        $contactId = isset($_GET['id']) ? (int) $_GET['id'] : null;
        $isUrlIDContact = (bool) $contactId;

        // Si aucun contact n'est sélectionné explicitement, on charge le premier de la liste par défaut (affiché sur desktop)
        if (!$contactId && !empty($conversations)) {
            $contactId = $conversations[0]['contact']->getId();
        }

        // Si on a un contactId (soit via l'URL, soit le premier par défaut)
        if ($contactId) {
            // Un utilisateur ne peut pas s'envoyer de message à lui-même
            if ($userId === $contactId) {
                $this->redirect('index.php?action=messages');
            }

            $contact = $userRepo->findById($contactId);

            // Si le contact n'existe pas en base de données
            if (!$contact) {
                $this->redirect('index.php?action=messages');
            }

            // Le contact est valide : on met à jour la lecture et on charge l'historique
            $messageRepo->markConversationAsRead($userId, $contact->getId());
            $messages = $messageRepo->getConversation($userId, $contact->getId());
        }


        $this->render('message/index', [
            'title' => 'Messagerie',
            'conversations' => $conversations,
            'contact' => $contact,
            'messages' => $messages,
            'userId' => $userId,
            'isUrlIDContact' => $isUrlIDContact,
            'csrf_token' => $_SESSION['csrf_token']
        ]);
    }

    /**
     * Traite l'action d'ajout de message (POST)
     */
    public function addMessage()
    {
        $this->isConnected();

        // Vérification du token reçu via POST avec celui de la session
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $csrfToken)) {
            throw new \Exception("Erreur de sécurité CSRF.");
        }

        $contactId = isset($_GET['id']) ? (int) $_GET['id'] : null;
        $content = trim($_POST['content'] ?? '');

        if ($contactId && !empty($content)) {
            // Validation de la longueur côté serveur
            if (mb_strlen($content) > 1000) {
                throw new \Exception("Le message est trop long (1000 caractères maximum).");
            }

            $userId = $this->getSessionUserId();

            $newMessage = new Message();
            $newMessage->setSenderId($userId);
            $newMessage->setReceiverId($contactId);
            $newMessage->setContent($content);

            $messageRepo = new MessageRepository();
            $messageRepo->add($newMessage);

            // Redirection vers la vue de la conversation après l'ajout
            $this->redirect('index.php?action=messages&id=' . $contactId);
        }

        // Si problème ou accès direct sans données, on réaiguille vers la messagerie générale
        $this->redirect('index.php?action=messages');
    }
}
