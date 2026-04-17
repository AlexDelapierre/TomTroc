<?php

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\Repository\MessageRepository;

class MessageController extends AbstractController
{
    public function list()
    {
        $repo = new MessageRepository();
        // $messages = $repo->findAll();

        // Appel de la méthode render héritée
        $this->render('message/index', [
            'title' => 'Messages',
            // 'messages' => $messages
        ]);
    }
}
