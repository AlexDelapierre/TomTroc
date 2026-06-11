<section>
    <div class="row g-0 bg-secondary">

        <div class="col-lg-6 py-5 form-container">
            <h1 class="my-5">Connexion</h1>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="index.php?action=login<?= isset($_GET['redirect']) ? '&redirect=' . htmlspecialchars($_GET['redirect']) : '' ?>"
                method="POST"
                class="white-form-fields">
                <div class="mb-5">
                    <label for="email" class="form-label text-xs">Adresse email</label>
                    <input type="email" name="email" id="email" class="form-control form-control-lg bg-white" placeholder="" autocomplete="username" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label text-xs">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control form-control-lg bg-white" placeholder="" autocomplete="current-password" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </div>
            </form>
            <div class="d-flex text-center gap-1 my-4">
                <p class="mb-0 text-dark text-xs">Pas de compte ?</p>
                <a href="index.php?action=register<?= isset($_GET['redirect']) ? '&redirect=' . htmlspecialchars($_GET['redirect']) : '' ?>" class="text-dark text-xs">Inscrivez-vous</a>
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
