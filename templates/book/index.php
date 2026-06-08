<section class="py-5 bg-secondary">
    <div class="container-md pt-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 mb-5">
            <h1 class="mb-3 mb-md-0">Nos livres à l’échange</h1>
            <form action="index.php" method="GET" class="position-relative white-form-fields search-form">
                <input type="hidden" name="action" value="books">
                <button type="submit" class="btn border-0 position-absolute top-50 translate-middle-y"
                    aria-label="Lancer la recherche">
                    <i class="bi bi-search text-medium-gray"></i>
                </button>
                <input type="search" name="search" class="form-control form-control-lg rounded-1 text-xs search-input" placeholder="Rechercher un livre..." value="<?= htmlspecialchars($search ?? '') ?>" aria-label="Rechercher">
            </form>
        </div>

        <ul class="row row-cols-2 row-cols-lg-4 list-unstyled home-list mt-5">
            <?php foreach ($books as $book): ?>
                <li class="col mb-4">
                    <?php include __DIR__ . '/../partials/_book_card.php'; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
