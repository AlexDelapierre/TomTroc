<article class="card h-100 bg-white border-0">
    <div class="container-sm py-5">
        <div class="row">
            <div class="col-4">
                <img src="<?= htmlspecialchars($book->getImage() ?? 'assets/img/default-book.jpg'); ?>"
                    class="card-img-top"
                    alt="Couverture du livre : <?= htmlspecialchars($book->getTitle()); ?>"
                    loading="lazy">
            </div>
            <div class="col-8">
                <h3 class="h5 card-title mb-3"><?= htmlspecialchars($book->getTitle()); ?></h3>
                <p class="card-text text-muted small">Par <?= htmlspecialchars($book->getAuthor()); ?></p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <?php if ($book->getIsAvailable()): ?>
                        <span class="badge rounded-pill px-3 py-2 text-white badge-available">disponible</span>
                    <?php else: ?>
                        <span class="badge rounded-pill px-3 py-2 text-white badge-not-available">non dispo.</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card-body d-flex flex-column">
            <div>
                <p class="card-text mt-auto">
                    <?= htmlspecialchars($book->getDescription() ?? 'Aucune description disponible.'); ?>
                </p>
                <div class="d-flex gap-2">
                    <a href="index.php?action=editBook&id=<?= $book->getId() ?>" class="text-dark text-decoration-underline me-3 small">Éditer</a>
                    <a href="index.php?action=deleteBook&id=<?= $book->getId() ?>" class="text-danger text-decoration-underline small">Supprimer</a>
                </div>
            </div>
        </div>
    </div>

</article>
