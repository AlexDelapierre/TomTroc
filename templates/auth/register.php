<section class="container">
    <div class="row align-items-center">

        <div class="col-lg-6 py-5">
            <h1 class="text-center h3 mb-4">Inscription</h1>

            <?php if (isset($errors) && !empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="index.php?action=register<?= isset($_GET['redirect']) ? '&redirect=' . htmlspecialchars($_GET['redirect']) : '' ?>" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Pseudo</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Votre pseudo" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="exemple@test.fr" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Minimum 8 caractères" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">S'inscrire</button>
                </div>
            </form>

            <div class="text-center my-4">
                <p class="mb-0 text-muted">Déjà inscrit ?</p>
                <a href="index.php?action=login" class="text-decoration-none">Connectez-vous</a>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <img src="assets/img/default-book.jpg"
                class="d-block mx-lg-auto img-fluid auth-cover"
                alt="Image d'illustration"
                loading="lazy">
        </div>

    </div>
</section>
