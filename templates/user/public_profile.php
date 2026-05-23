<div class="bg-secondary">
    <section class="container">

        <div class="row g-4 align-items-stretch py-5">

            <div class="col-12 col-lg-4">
                <div class="d-flex flex-column justify-content-center text-center rounded-4 bg-white">
                    <?php $avatarPath = $user->getAvatar() ? 'uploads/avatars/' . htmlspecialchars($user->getAvatar()) : 'assets/img/default-avatar.jpg'; ?>
                    <div>
                        <img src="<?= $avatarPath ?>"
                            class="rounded-circle mb-2 d-block mx-auto profile-avatar"
                            alt="Avatar de <?= htmlspecialchars($user->getUsername()) ?>"
                            loading="lazy">
                    </div>
                    <hr>
                    <div>
                        <h2><?= htmlspecialchars($user->getUsername()) ?></h2>
                        <?php $age = $user->getAccountAge(); ?>
                        <p>
                            Membre depuis <?= ($age->y > 0) ? $age->y . " an(s)" : $age->days . " jours" ?>
                        </p>
                        <p>Bibliothèque</p>
                        <p class="d-flex justify-content-center align-items-center">
                            <img src="assets/icons/books.svg" alt="Icône livres" width="20" height="20" class="me-2">
                            <?= $bookCount ?> livre<?= $bookCount > 1 ? 's' : '' ?>
                        </p>
                    </div>
                    <div class="text-center mt-4">
                        <a href="/boutique" class="btn btn-secondary btn-lg px-4 rounded-2">Écrire un message</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8 d-none d-lg-block">
                <div class="h-100 rounded-4 overflow-hidden bg-white">
                    <table class="table table-striped table-hover mb-0 align-middle h-100">
                        <thead>
                            <tr class="small fw-bold text-muted">
                                <th class="ps-4 py-3">PHOTO</th>
                                <th class="py-3">TITRE</th>
                                <th class="py-3">AUTEUR</th>
                                <th class="py-3">DESCRIPTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($books as $book): ?>
                                <tr>
                                    <td class="ps-4">
                                        <img src="<?= htmlspecialchars($book->getImage() ?? '') ?>" alt="Couverture" class="img-fluid book-img-custom">
                                    </td>
                                    <td class="fw-normal"><?= htmlspecialchars($book->getTitle()) ?></td>
                                    <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                                    <td class="fst-italic text-secondary small description-cell">
                                        <?= htmlspecialchars($book->getDescription()) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>

    <section>
        <div class="container d-block d-lg-none mb-5">
            <div class="d-flex flex-column gap-4">
                <?php foreach ($books as $book): ?>
                    <?php include __DIR__ . '/../partials/_profile_book_card.php'; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>
