<?php

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\Repository\MessageRepository;
use App\Model\Repository\UserRepository;
use App\Model\Entity\Message;

class MessageController extends AbstractController
{
    public function showMessages()
    {
        $this->isConnected();
        $userId = $this->getSessionUserId();

        $repo = new MessageRepository();
        $userRepo = new UserRepository();
        $conversations = $repo->getLastMessagesByUser($userId);

        $contact = null;
        $messages = [];
        $contactId = isset($_GET['id']) ? (int) $_GET['id'] : null;
        $isUrlIDContact = (bool) $contactId;

        // Si aucun contact n'est sélectionné explicitement, on charge le permier de la liste par défaut (affiché sur desktop)
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

        if ($contact) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $content = trim($_POST['content'] ?? '');
                if (!empty($content)) {
                    $newMessage = new Message();
                    $newMessage->setSenderId($userId);
                    $newMessage->setReceiverId($contact->getId());
                    $newMessage->setContent($content);

                    $repo->add($newMessage);
                    $this->redirect('index.php?action=messages&id=' . $contact->getId());
                }
            }

            $messages = $repo->getConversation($userId, $contact->getId());
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
}
