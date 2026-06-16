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

        $messageRepo = new MessageRepository();
        $userRepo = new UserRepository();
        $conversations = $messageRepo->getLastMessagesByUser($userId);

        $contact = null;
        $messages = [];
        $contactId = isset($_GET['id']) ? (int) $_GET['id'] : null;
        $isUrlIDContact = (bool) $contactId;

        // Si aucun contact n'est sélectionné explicitement, on charge le premier de la liste par défaut (affiché sur desktop)
        if (!$contactId && !empty($conversations)) {
            $contactId = $conversations[0]['contact']->getId();
        }

        if ($contactId) {
            if ($userId === $contactId) {
                $this->redirect('index.php?action=messages');
            }

            $contact = $userRepo->findById($contactId);
            if (!$contact) {
                $this->redirect('index.php?action=messages');
            }
        }

        // Si un contact est sélectionné, on marque les messages de ce contact comme lus ...
        // et on récupère les messages de la conversation
        if ($contact) {
            $messageRepo->markConversationAsRead($userId, $contact->getId());
            $messages = $messageRepo->getConversation($userId, $contact->getId());
        }

        $this->render('message/index', [
            'title' => 'Messagerie',
            'conversations' => $conversations,
            'contact' => $contact,
            'messages' => $messages,
            'userId' => $userId,
            'isUrlIDContact' => $isUrlIDContact
        ]);
    }

    /**
     * Traite l'action d'ajout de message (POST)
     */
    public function addMessage()
    {
        $this->isConnected();

        $contactId = isset($_GET['id']) ? (int) $_GET['id'] : null;
        $content = trim($_POST['content'] ?? '');

        if ($contactId && !empty($content)) {
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
