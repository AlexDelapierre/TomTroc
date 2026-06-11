<?php
// On vérifie si on doit appliquer le scroll vertical (4 lignes max)
$isPublic = ($_GET['action'] ?? '') === 'publicProfile';
?>
<div class="table-responsive bg-secondary <?= $isPublic ? 'custom-scroll' : '' ?>">
    <table class="table table-striped table-hover mb-0 align-middle">
        <thead class="bg-white">
            <tr>
                <th class="ps-4 py-3 text-xxxs">PHOTO</th>
                <th class="py-3 text-xxxs">TITRE</th>
                <th class="py-3 text-xxxs">AUTEUR</th>
                <th class="py-3 text-xxxs">DESCRIPTION</th>
                <?php if (!empty($isEditable) && $isEditable === true): ?>
                    <th class="py-3 text-xxxs">DISPONIBILITÉ</th>
                    <th class="py-3 text-xxxs">ACTION</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td class="ps-4">
                        <?php $profileBookImage = $book->getImage() ? 'uploads/books/' . htmlspecialchars($book->getImage()) : 'assets/img/default-book.jpg'; ?>
                        <a href="index.php?action=book&id=<?= $book->getId(); ?>">
                            <img src="<?= $profileBookImage ?>"
                                alt="Couverture du livre : <?= htmlspecialchars($book->getTitle()); ?>"
                                class="img-fluid book-img-custom">
                        </a>
                    </td>
                    <td class="fw-normal"><?= htmlspecialchars($book->getTitle()) ?></td>
                    <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                    <td>
                        <div class="small description-text">
                            <?= htmlspecialchars($book->getDescription()) ?>
                        </div>
                    </td>
                    <?php if (!empty($isEditable) && $isEditable === true): ?>
                        <td>
                            <?php if ($book->getIsAvailable()): ?>
                                <span class="badge rounded-pill px-3 py-2 text-white badge-available">disponible</span>
                            <?php else: ?>
                                <span class="badge rounded-pill px-3 py-2 text-white badge-not-available">non dispo.</span>
                            <?php endif; ?>
                        </td>
                        <td class="pe-4">
                            <a href="index.php?action=editBook&id=<?= $book->getId() ?>" class="text-dark text-decoration-underline me-3 small">Éditer</a>
                            <a href="index.php?action=deleteBook&id=<?= $book->getId() ?>" class="text-danger text-decoration-underline small">Supprimer</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
