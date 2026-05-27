<article class="card h-100 bg-white border-0">
    <img src="<?= htmlspecialchars($book->getImage() ?? 'assets/img/default-book.jpg'); ?>"
        class="card-img-top book-cover-img"
        alt="Couverture du livre : <?= htmlspecialchars($book->getTitle()); ?>">

    <div class="card-body d-flex flex-column">
        <h3 class="h5 card-title">
            <a href="index.php?action=book&id=<?= $book->getId(); ?>" class="text-decoration-none text-dark stretched-link">
                <?= htmlspecialchars($book->getTitle()); ?>
            </a>
        </h3>

        <p class="card-text text-muted small">Par <?= htmlspecialchars($book->getAuthor()); ?></p>

        <p class="card-text mt-auto">
            <strong>Vendu par :</strong> <?= htmlspecialchars($book->getUser()->getUsername()); ?>
        </p>
    </div>
</article>
