<section class="py-5 bg-secondary">
    <div class="container container-sm">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
            <h1 class="mb-3 mb-md-0">Nos livres à l’échange</h1>
            <form action="" method="GET" class="d-flex input-group" style="max-width: 300px;">
                <input type="hidden" name="action" value="books">
                <input type="search" name="search" class="form-control" placeholder="Rechercher un livre..." value="<?= htmlspecialchars($search ?? '') ?>" aria-label="Rechercher">
                <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
            </form>
        </div>

        <ul class="row list-unstyled">
            <?php foreach ($books as $book): ?>
                <li class="col-6 col-lg-3 mb-4">
                    <?php include __DIR__ . '/../partials/_book_card.php'; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
