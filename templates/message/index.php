<section class="container-navbar-width flex-grow-1 d-flex flex-column">

    <div class="row flex-grow-1">
        <!-- Liste des messages (visible tout le temps sur desktop, visible sur mobile si pas de message sélectionné) -->
        <div class="col-12 col-md-3 bg-secondary py-5 <?= !empty($isUrlIDContact) ? 'd-none d-md-flex' : 'd-flex' ?> flex-column overflow-auto hide-scrollbar">
            <h1 class="h3 mb-4">Messagerie</h1>
            <div>
                <?php if (empty($conversations)) : ?>
                    <p class="text-muted p-3 mb-0 bg-white">Vous n'avez aucun message.</p>
                <?php else : ?>
                    <?php foreach ($conversations as $conv) :
                        $listContact = $conv['contact'];
                        $lastMsg = $conv['message'];
                        $avatar = $listContact->getAvatar() ? 'uploads/avatars/' . htmlspecialchars($listContact->getAvatar()) : 'assets/img/default-avatar.jpg';
                        $isActive = (isset($contact) && $contact && $listContact->getId() === $contact->getId()) ? 'bg-white' : '';
                        ?>
                        <a href="index.php?action=messages&id=<?= $listContact->getId() ?>"
                            class="d-flex flex-row align-items-center flex-nowrap text-decoration-none p-3 <?= $isActive ?>">
                            <!-- Colonne 1 : Avatar -->
                            <div class="me-3 msg-contact-avatar">
                                <img src="<?= $avatar ?>" alt="Avatar" class="rounded-circle avatar-sm">
                            </div>

                            <!-- Colonne 2 : Username & Message -->
                            <div class="overflow-hidden msg-contact-content">
                                <span class="d-block fw-bold text-dark text-xs mb-1"><?= htmlspecialchars($listContact->getUsername()) ?></span>
                                <span class="d-block text-truncate text-xss"><?= htmlspecialchars($lastMsg->getContent()) ?></span>
                            </div>

                            <!-- Colonne 3 : Heure -->
                            <span class="text-xs text-dark text-end ms-3"><?= $lastMsg->getCreatedAt()->format('H:i') ?></span>
                        </a>
                        <div class="bg-white msg-separator"></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-12 col-md-9 <?= !empty($isUrlIDContact) ? 'd-flex' : 'd-none d-md-flex' ?> flex-column pe-md-5">
            <?php if (!empty($contact)) : ?>
                <div class="d-flex flex-column h-100">
                    <!-- En-tête conversation -->
                    <div class="d-flex flex-column p-3 mb-5">
                        <?php
                            $contactAvatar = $contact->getAvatar() ? 'uploads/avatars/' . htmlspecialchars($contact->getAvatar()) : 'assets/img/default-avatar.jpg';
                ?>
                        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3">
                            <a href="index.php?action=messages" class="d-md-none text-decoration-none text-secondary">
                                <i class="bi bi-arrow-left"></i> retour
                            </a>
                            <div class="d-flex align-items-center gap-3">
                                <img src="<?= $contactAvatar ?>" alt="Avatar de <?= htmlspecialchars($contact->getUsername()) ?>"
                                    class="rounded-circle msg-avatar-header">
                                <h2 class="fs-6 mb-0 fw-bold"><?= htmlspecialchars($contact->getUsername()) ?></h2>
                            </div>
                        </div>
                    </div>

                    <!-- Corps de la conversation -->
                    <div class="overflow-auto hide-scrollbar mb-5 msg-conversation-body">
                        <?php foreach ($messages as $msg) :
                            $isMe = ($msg->getSenderId() === $userId);
                            ?>
                            <div class="d-flex <?= $isMe ? 'justify-content-end' : 'justify-content-start' ?>">
                                <div class="d-flex flex-column msg-bubble-wrapper">
                                    <!-- Ligne contenant avatar (si pas moi) + date/heure -->
                                    <div class="d-flex align-items-center gap-2 mb-1 <?= $isMe ? 'justify-content-end' : '' ?>">
                                        <?php if (!$isMe) : ?>
                                            <img src="<?= $contactAvatar ?>" alt="Avatar de <?= htmlspecialchars($contact->getUsername()) ?>" class="rounded-circle msg-avatar-bubble">
                                        <?php endif; ?>
                                        <span class="small text-muted"><?= $msg->getCreatedAt()->format('d/m H:i') ?></span>
                                    </div>
                                    <!-- Bulle de message -->
                                    <div class="p-2 text-start d-inline-block text-break <?= $isMe ? 'bg-tertiary' : 'bg-white' ?>">
                                        <?= nl2br(htmlspecialchars($msg->getContent())) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Formulaire d'envoi -->
                    <div class="mb-4">
                        <form action="index.php?action=messages&id=<?= $contact->getId() ?>" method="POST" class="d-flex flex-column flex-md-row gap-2">
                            <input type="text" name="content" class="form-control form-control-sm bg-white" placeholder="Tapez votre message ici" required>
                            <button type="submit" class="btn btn-primary btn-sm">Envoyer</button>
                        </form>
                    </div>
                </div>
            <?php else : ?>
                <div class="card h-100 min-vh-50 border-0 shadow-sm align-items-center justify-content-center bg-white">
                    <p class="text-muted fs-5 mb-0">Sélectionnez une conversation</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
