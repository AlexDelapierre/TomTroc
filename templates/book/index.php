<section class="py-5 bg-secondary">
    <div class="container-md pt-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 mb-5">
            <h1 class="mb-3 mb-md-0">Nos livres à l’échange</h1>
            <form action="" method="GET" class="position-relative" style="max-width: 300px; width: 100%;">
                <input type="hidden" name="action" value="books">
                <button type="submit" class="btn border-0 position-absolute top-50 translate-middle-y text-secondary" style="left: 0; z-index: 10; cursor: pointer;">
                    <i class="bi bi-search"></i>
                </button>
                <input type="search" name="search" class="form-control" style="padding-left: 40px; border-radius: 15px;" placeholder="Rechercher un livre..." value="<?= htmlspecialchars($search ?? '') ?>" aria-label="Rechercher">
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
