<section class="container">

    <h1 class="h2 mb-5">Mon compte</h1>
    <form action="index.php?action=updateProfile<?= isset($_GET['redirect']) ? '&redirect=' . htmlspecialchars($_GET['redirect']) : '' ?>" method="POST" enctype="multipart/form-data">

        <div class="row align-items-stretch g-4">

            <div class="col-12 col-lg-6">
                <div class="text-center bg-secondary h-100 p-4 d-flex flex-column justify-content-center">
                    <?php $avatarPath = $user->getAvatar() ? 'uploads/avatars/' . htmlspecialchars($user->getAvatar()) : 'assets/img/default-avatar.jpg'; ?>
                    <div>
                        <img src="<?= $avatarPath ?>"
                            class="rounded-circle mb-2 d-block mx-auto"
                            style="width: 150px; height: 150px; object-fit: cover;"
                            alt="Avatar de <?= htmlspecialchars($user->getUsername()) ?>"
                            loading="lazy">
                        <br>
                        <label for="avatar" class="text-primary" style="cursor: pointer; text-decoration: underline;">Modifier l'avatar</label>
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
            </div>

            <div class="col-12 col-lg-6">
                <div class="bg-secondary h-100 p-4 d-flex flex-column justify-content-center">
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

        </div>
    </form>
</section>
