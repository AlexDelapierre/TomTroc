<?php $isEditable = false; ?>

<div class="bg-secondary h-100 py-5">
    <div class="container-navbar-width">

        <div class="row g-4 align-items-stretch py-5">

            <div class="col-12 col-lg-4">
                <?php
                include __DIR__ . '/../partials/_UserProfileCard.php';
?>
            </div>

            <div class="col-12 col-lg-8 d-none d-lg-block">
                <div class="h-100 rounded-4 overflow-hidden bg-white">
                    <?php
    include __DIR__ . '/../partials/_BookListTable.php';
?>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-block d-lg-none mb-5">
        <div class="d-flex flex-column gap-4">
            <?php foreach ($books as $book): ?>
                <?php include __DIR__ . '/../partials/_profile_book_card.php'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
