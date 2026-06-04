<?php $isEditable = ($_GET['action'] ?? '') === 'profile'; ?>

<div class="bg-secondary py-5">
    <section class="container-navbar-width ">
        <h1 class="h3 my-5">Mon compte</h1>
        <form action="index.php?action=updateProfile<?= isset($_GET['redirect']) ? '&redirect=' . htmlspecialchars($_GET['redirect']) : '' ?>" method="POST" enctype="multipart/form-data">
            <div class="row align-items-stretch g-4">
                <div class="col-12 col-lg-6">
                    <?php
                    include __DIR__ . '/../partials/_UserProfileCard.php';
                    ?>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="h-100 d-flex flex-column justify-content-center bg-white form-profile-container">
                        <h3 class="h6 mb-4">Vos informations personnelles</h3>

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>

                        <div class="mb-4">
                            <label for="email" class="form-label text-xs">Adresse email</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="" value="<?= htmlspecialchars($user->getEmail()) ?>" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label text-xs">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="" required>
                        </div>

                        <div class="mb-4">
                            <label for="username" class="form-label text-xs">Pseudo</label>
                            <input type="text" name="username" id="username" class="form-control form-control-lg" placeholder="" value="<?= htmlspecialchars($user->getUsername()) ?>" required>
                        </div>

                        <div class="d-flex justify-content-start">
                            <button type="submit" class="btn btn-secondary">Enregistrer</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <section>
        <div class="d-block d-lg-none my-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h4 mb-0">Ma bibliothèque</h2>
                <a href="index.php?action=addBook" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Ajouter un livre
                </a>
            </div>
            <div class="d-flex flex-column gap-4">
                <?php foreach ($books as $book): ?>
                    <?php include __DIR__ . '/../partials/_profile_book_card.php'; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="container-navbar-width d-none d-lg-block my-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h4 mb-0">Ma bibliothèque</h2>
                <a href="index.php?action=addBook" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Ajouter un livre
                </a>
            </div>
            <?php
            include __DIR__ . '/../partials/_BookListTable.php';
            ?>
        </div>
    </section>
</div>
