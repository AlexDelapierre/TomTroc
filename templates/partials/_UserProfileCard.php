<div class="text-center h-100 d-flex flex-column justify-content-center p-5 bg-white">
    <?php $avatarPath = $user->getAvatar() ? 'uploads/avatars/' . htmlspecialchars($user->getAvatar()) : 'assets/img/default-avatar.jpg'; ?>
    <div>
        <img src="<?= $avatarPath ?>"
            class="rounded-circle d-block mx-auto profile-avatar image-preview"
            alt="Avatar de <?= htmlspecialchars($user->getUsername()) ?>"
            loading="lazy">
        <?php if (!empty($isEditable) && $isEditable === true): ?>
            <label for="avatar" class="text-medium-gray text-xs text-decoration-underline cursor-pointer profile-avatar-label">Modifier</label>
            <input class="d-none image-input" type="file" id="avatar" name="avatar" accept="image/*">
        <?php endif; ?>
    </div>
    <hr class="w-50 mx-auto hr-thin my-5">
    <div class="mb-5">
        <div class="h4"><?= htmlspecialchars($user->getUsername()) ?></div>
        <?php $age = $user->getAccountAge(); ?>
        <p class="text-xs">
            Membre depuis : <?= htmlspecialchars($user->getFormattedAnciennete()) ?>
        </p>
        <p class="text-xss text-dark mb-0">Bibliothèque</p>
        <p class="d-flex justify-content-center align-items-center text-xs text-dark mb-1">
            <img src="assets/icons/books.svg" alt="Icône livres" width="15" height="15" class="me-2">
            <?= $bookCount ?> livre<?= $bookCount > 1 ? 's' : '' ?>
        </p>
        <?php
        // Si la page est éditable, on ne cherche pas plus loin : on n'affiche jamais le bouton
        $showButton = false;

        if (isset($isEditable) && $isEditable === false) {
            // Si on est sur une page publique, on affiche le bouton...
            $showButton = true;

            // ... SAUF si l'utilisateur est connecté ET qu'il est le propriétaire du livre
            if (isset($_SESSION['user']['id']) && (int)$_SESSION['user']['id'] === $user->getId()) {
                $showButton = false;
            }
        }

        if ($showButton):
        ?>
            <div class="text-center mt-5">
                <a href="index.php?action=messages&id=<?= $user->getId() ?>" class="btn btn-secondary">Écrire un message</a>
            </div>
        <?php endif; ?>
    </div>
</div>
