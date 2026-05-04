<section class="container container-sm">
    <h1 class="text-center h3 mb-4">Inscription</h1>
    <form action="index.php?action=edit&id=<?= htmlspecialchars($_GET['id'] ?? '') ?>" method="POST">
    <div class="row align-items-center">

        <div class="col-12 col-lg-6">
            <img src="assets/img/default-book.jpg"
                class="d-block mx-lg-auto img-fluid auth-cover"
                alt="Image d'illustration"
                loading="lazy">

            <div class="mt-4">
                <label for="image" class="form-label">Modifier l'image</label>
                <input type="url" name="image" id="image" class="form-control" placeholder="<?= htmlspecialchars($book->getImage()); ?>" value="<?= htmlspecialchars($_POST['image'] ?? '') ?>">
            </div>
        </div>


        <div class="col-lg-6 py-5">

            <?php if (isset($errors) && !empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>



                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="<?= htmlspecialchars($book->getTitle()); ?>" value="<?= htmlspecialchars($_POST['title'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Auteur</label>
                    <input type="text" name="author" id="author" class="form-control" placeholder="<?= htmlspecialchars($book->getAuthor()); ?>" value="<?= htmlspecialchars($_POST['author'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="<?= htmlspecialchars($book->getDescription()); ?>" value="<?= htmlspecialchars($_POST['description'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="availability" class="form-label">Disponibilité</label>
                    <select name="availability" id="availability" class="form-control" required>
                        <option value="disponible" <?= (htmlspecialchars($_POST['availability'] ?? '') === 'disponible') ? 'selected' : '' ?>>Disponible</option>
                        <option value="indisponible" <?= (htmlspecialchars($_POST['availability'] ?? '') === 'indisponible') ? 'selected' : '' ?>>Indisponible</option>
                    </select>
                </div>



                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Valider</button>
                </div>



            </div>

    </div>
        </form>
</section>
