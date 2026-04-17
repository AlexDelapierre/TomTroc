<h1><?= $title ?></h1>

<div class="book-grid">
    <?php foreach ($books as $book): ?>
        <article>
            <img src="/img/<?= $book->getImage() ?>" alt="<?= $book->getTitle() ?>">
            <h2><?= $book->getTitle() ?></h2>
            <p>Auteur : <?= $book->getAuthor() ?></p>
        </article>
    <?php endforeach; ?>
</div>
