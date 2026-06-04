<section class="mt-4">
    <nav aria-label="breadcrumb" class="container-navbar-width d-none d-lg-block">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-xxs text-medium-gray"><a href="index.php?action=books" class="text-decoration-none text-xxs text-medium-gray">Nos livres</a></li>
            <li class="breadcrumb-item text-xxs text-medium-gray" aria-current="page"><?= htmlspecialchars($book->getTitle()); ?></li>
        </ol>
    </nav>
    <div class="row g-0 bg-secondary">
        <div class="col-12 col-sm-8 col-lg-6">
            <?php $showBookImage = $book->getImage() ? 'uploads/books/' . htmlspecialchars($book->getImage()) : 'assets/img/default-book.jpg'; ?>
            <img src="<?= $showBookImage ?>"
                class="d-block w-100 img-fluid object-fit-cover"
                alt="Couverture du livre : <?= htmlspecialchars($book->getTitle()) ?>" width="700" height="500" loading="lazy">
        </div>

        <div class="col-lg-6 p-custom-large">
            <h1 class="mb-3">
                <?= htmlspecialchars($book->getTitle()); ?>
            </h1>
            <p class="text-medium-gray mb-4">Par <?= htmlspecialchars($book->getAuthor()); ?></p>

            <hr class="hr-short">

            <p class="text-xxs fw-bold text-dark mt-4 mb-3">Description</p>
            <p class="mb-4">
                <?= htmlspecialchars($book->getDescription() ?? 'Aucune description disponible.'); ?>
            </p>

            <p class="text-xxs fw-bold text-dark mb-4">Propriétaire</p>
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

            <div class="d-grid mt-5">
                <a href="index.php?action=messages&id=<?= $book->getUser()->getId(); ?>" class="btn btn-primary rounded-3 w-100">
                    Envoyer un message
                </a>
            </div>
        </div>
    </div>
</section>
