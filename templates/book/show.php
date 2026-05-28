<section class="container">
    <div class="row py-5 bg-secondary">

        <div class="col-10 col-sm-8 col-lg-6">
            <?php $showBookImage = $book->getImage() ? 'uploads/books/' . htmlspecialchars($book->getImage()) : 'assets/img/default-book.jpg'; ?>
            <img src="<?= $showBookImage ?>"
                class="d-block mx-lg-auto img-fluid"
                alt="Couverture du livre : <?= htmlspecialchars($book->getTitle()) ?>" width="700" height="500" loading="lazy">
        </div>

        <div class="col-lg-6">
            <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">
                <?= htmlspecialchars($book->getTitle()); ?>
            </h1>
            <p class="h4 text-muted mb-3">Par <?= htmlspecialchars($book->getAuthor()); ?></p>

            <hr class="w-25">

            <p class="fw-bold mb-1">Description</p>
            <p class="lead">
                <?= htmlspecialchars($book->getDescription() ?? 'Aucune description disponible.'); ?>
            </p>

            <p class="fw-bold mb-4">Propriétaire</p>
            <a href="index.php?action=publicProfile&id=<?= $book->getUser()->getId(); ?>" class="text-decoration-none text-dark d-inline-block">
                <div class="d-inline-flex align-items-center rounded-5 bg-white p-2 pe-4 mb-4 user-badge-hover">
                    <?php $avatarPath = $book->getUser()->getAvatar() ? 'uploads/avatars/' . htmlspecialchars($book->getUser()->getAvatar()) : 'assets/img/default-avatar.jpg'; ?>
                    <img src="<?= $avatarPath ?>"
                        class="rounded-circle me-3 avatar-sm"
                        alt="Avatar de <?= htmlspecialchars($book->getUser()->getUsername()) ?>"
                        loading="lazy">
                    <p class="lead mb-0">
                        <?= htmlspecialchars($book->getUser()->getUsername()); ?>
                    </p>
                </div>
            </a>

            <div class="d-grid mt-4">
                <a href="index.php?action=messages&id=<?= $book->getUser()->getId(); ?>" class="btn btn-primary btn-lg rounded-2 w-100">
                    Envoyer un message
                </a>
            </div>
        </div>

    </div>
</section>
