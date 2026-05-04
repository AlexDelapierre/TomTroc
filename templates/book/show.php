<section class="container container-sm">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">

        <div class="col-10 col-sm-8 col-lg-6">
            <img src="<?= htmlspecialchars($book->getImage() ?? 'assets/img/default-book.jpg'); ?>"
                class="d-block mx-lg-auto img-fluid"
                alt="Bootstrap Themes" width="700" height="500" loading="lazy">
        </div>

        <div class="col-lg-6">
            <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">
                <?= htmlspecialchars($book->getTitle()); ?>
            </h1>
            <p class="h4 text-muted mb-3">Par <?= htmlspecialchars($book->getAuthor()); ?></p>

            <p class="fw-bold mb-1">Description</p>
            <p class="lead">
                <?= htmlspecialchars($book->getDescription() ?? 'Aucune description disponible.'); ?>
            </p>

            <p class="fw-bold mb-1">Propriétaire</p>
            <p class="lead">
                <?= htmlspecialchars($book->getUser()->getUsername()); ?>
            </p>

            <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
                <a href="index.php?action=contact&id=<?= $book->getId(); ?>" class="btn btn-primary btn-lg px-4 me-md-2 rounded-2">
                    Envoyer un message
                </a>
            </div>
        </div>

    </div>
</section>
