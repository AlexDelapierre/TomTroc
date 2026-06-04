<div class="text-center h-100 d-flex flex-column justify-content-center p-5 bg-white">
    <?php $avatarPath = $user->getAvatar() ? 'uploads/avatars/' . htmlspecialchars($user->getAvatar()) : 'assets/img/default-avatar.jpg'; ?>
    <div>
        <img src="<?= $avatarPath ?>"
            class="rounded-circle d-block mx-auto profile-avatar"
            alt="Avatar de <?= htmlspecialchars($user->getUsername()) ?>"
            loading="lazy">
        <?php if (!empty($isEditable) && $isEditable === true): ?>
            <label for="avatar" class="text-medium-gray text-xs text-decoration-underline profile-avatar-label" style="cursor: pointer;">Modifier</label>
            <input class="d-none" type="file" id="avatar" name="avatar" accept="image/*">
        <?php endif; ?>
    </div>
    <hr class="w-50 mx-auto hr-thin my-5">
    <div class="mb-5">
        <h2 class="h4"><?= htmlspecialchars($user->getUsername()) ?></h2>
        <?php $age = $user->getAccountAge(); ?>
        <p class="text-xs">
            Membre depuis <?= ($age->y > 0) ? $age->y . " an(s)" : $age->days . " jours" ?>
        </p>
        <p class="text-xss text-dark mb-0">Bibliothèque</p>
        <p class="d-flex justify-content-center align-items-center text-xs text-dark mb-1">
            <img src="assets/icons/books.svg" alt="Icône livres" width="15" height="15" class="me-2">
            <?= $bookCount ?> livre<?= $bookCount > 1 ? 's' : '' ?>
        </p>
        <?php if (!empty($isEditable) && $isEditable === false): ?>
            <div class="text-center mt-5">
                <a href="index.php?action=messages&id=<?= $user->getId() ?>" class="btn btn-secondary btn-lg px-4 rounded-2 border-primary fw-bold text-dark bg-white">Écrire un message</a>
            </div>
        <?php endif; ?>
    </div>
</div>
