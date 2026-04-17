<div class="row justify-content-center">
    <div class="col-md-8 col-lg-5">
        <div class="card shadow-sm mt-5">
            <div class="card-body p-4 p-md-5">
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

                <form action="index.php?action=register" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Pseudo</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Votre pseudo" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
                        <div class="form-text">Ce nom sera affiché à côté de vos livres.</div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="exemple@test.fr" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Minimum 8 caractères" required>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirm" class="form-label">Confirmez le mot de passe</label>
                        <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Répétez votre mot de passe" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Créer mon compte</button>
                    </div>
                </form>

                <hr class="my-4">

                <div class="text-center">
                    <p class="mb-0 text-muted">Déjà membre ?</p>
                    <a href="/login" class="text-decoration-none">Connectez-vous ici</a>
                </div>
            </div>
        </div>
    </div>
</div>
