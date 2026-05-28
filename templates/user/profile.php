<section class="container">

    <h1 class="h2 mb-5">Mon compte</h1>
    <form action="index.php?action=updateProfile<?= isset($_GET['redirect']) ? '&redirect=' . htmlspecialchars($_GET['redirect']) : '' ?>" method="POST" enctype="multipart/form-data">
        <div class="row align-items-stretch g-4">
            <div class="col-12 col-lg-6 text-center h-100 p-4 d-flex flex-column justify-content-center bg-secondary">
                <?php $avatarPath = $user->getAvatar() ? 'uploads/avatars/' . htmlspecialchars($user->getAvatar()) : 'assets/img/default-avatar.jpg'; ?>
                <div>
                    <img src="<?= $avatarPath ?>"
                        class="rounded-circle mb-2 d-block mx-auto profile-avatar"
                        alt="Avatar de <?= htmlspecialchars($user->getUsername()) ?>"
                        loading="lazy">
                    <br>
                    <label for="avatar" class="text-primary text-decoration-underline profile-avatar-label">Modifier</label>
                    <input class="d-none" type="file" id="avatar" name="avatar" accept="image/*">
                </div>
                <hr>
                <div>
                    <h2><?= htmlspecialchars($user->getUsername()) ?></h2>
                    <?php $age = $user->getAccountAge(); ?>
                    <p>
                        Membre depuis <?= ($age->y > 0) ? $age->y . " an(s)" : $age->days . " jours" ?>
                    </p>
                    <p>Bibliothèque</p>
                    <p class="d-flex justify-content-center align-items-center">
                        <img src="assets/icons/books.svg" alt="Icône livres" width="20" height="20" class="me-2">
                        <?= $bookCount ?> livre<?= $bookCount > 1 ? 's' : '' ?>
                    </p>
                </div>
            </div>
            <div class="col-12 col-lg-6 h-100 p-4 d-flex flex-column justify-content-center bg-secondary">
                <h3 class="text-center h3 mb-4">Vos informations personnelles</h3>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="exemple@test.fr" value="<?= htmlspecialchars($user->getEmail()) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Pseudo</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Votre pseudo" value="<?= htmlspecialchars($user->getUsername()) ?>" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-secondary">Enregistrer</button>
                </div>
            </div>
        </div>
    </form>
</section>

<section>
    <div class="container d-block d-lg-none my-5">
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

    <div class="container d-none d-lg-block my-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 mb-0">Ma bibliothèque</h2>
            <a href="index.php?action=addBook" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Ajouter un livre
            </a>
        </div>
        <div class="table-responsive bg-secondary">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead>
                    <tr class="small fw-bold text-muted">
                        <th class="ps-4 py-3">PHOTO</th>
                        <th class="py-3">TITRE</th>
                        <th class="py-3">AUTEUR</th>
                        <th class="py-3">DESCRIPTION</th>
                        <th class="py-3 text-center">DISPONIBILITÉ</th>
                        <th class="py-3 text-center pe-4">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td class="ps-4">
                                <?php $profileBookImage = $book->getImage() ? 'uploads/books/' . htmlspecialchars($book->getImage()) : 'assets/img/default-book.jpg'; ?>
                                <img src="<?= $profileBookImage ?>" alt="Couverture" class="img-fluid book-img-custom">
                            </td>
                            <td class="fw-normal"><?= htmlspecialchars($book->getTitle()) ?></td>
                            <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                            <td class="fst-italic text-secondary small description-cell">
                                <?= htmlspecialchars($book->getDescription()) ?>
                            </td>
                            <td class="text-center">
                                <?php if ($book->getIsAvailable()): ?>
                                    <span class="badge rounded-pill px-3 py-2 text-white badge-available">disponible</span>
                                <?php else: ?>
                                    <span class="badge rounded-pill px-3 py-2 text-white badge-not-available">non dispo.</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center pe-4">
                                <a href="index.php?action=editBook&id=<?= $book->getId() ?>" class="text-dark text-decoration-underline me-3 small">Éditer</a>
                                <a href="index.php?action=deleteBook&id=<?= $book->getId() ?>" class="text-danger text-decoration-underline small">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
