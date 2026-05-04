<section class="container">
    <div class="row align-items-center">

        <div class="col-lg-6 py-5">
            <h1 class="text-center h3 mb-4">Connexion</h1>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="index.php?action=login<?= isset($_GET['redirect']) ? '&redirect=' . htmlspecialchars($_GET['redirect']) : '' ?>" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="exemple@test.fr" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </div>
            </form>

            <div class="text-center my-4">
                <p class="mb-0 text-muted">Pas encore de compte ?</p>
                <a href="index.php?action=register<?= isset($_GET['redirect']) ? '&redirect=' . htmlspecialchars($_GET['redirect']) : '' ?>" class="text-decoration-none">Créer un compte TomTroc</a>
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
