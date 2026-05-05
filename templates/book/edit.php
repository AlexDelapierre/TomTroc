<section class="container mt-5">
    <h1 class="h3 my-4"><?= htmlspecialchars($title ?? 'Modifier le livre'); ?></h1>
    <form action="index.php?action=edit&id=<?= htmlspecialchars($_GET['id'] ?? '') ?>" method="POST" enctype="multipart/form-data">
        <div class="row align-items-center bg-secondary mb-5">

            <div class="col-12 col-lg-6">
                <?php
                if (!empty($_GET['id'])) {
                    $ImagePath = $book->getImage() ? 'uploads/books/' . htmlspecialchars($book->getImage()) : 'assets/img/default-book.jpg';
                } else {
                    $ImagePath = 'assets/img/default-book.jpg';
                }
                ?>

                <img src="<?= htmlspecialchars($ImagePath) ?>"
                    class="d-block mx-lg-auto img-fluid edit-book-cover"
                    alt="Image d'illustration"
                    loading="lazy">

                <div class="mt-4">
                    <label for="image" class="text-primary text-decoration-underline edit-image-label">Modifier l'image</label>
                    <input class="d-none" type="file" id="image" name="image" accept="image/*">
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
                    <textarea name="description" id="description" class="form-control" placeholder="<?= htmlspecialchars($book->getDescription()); ?>" rows="4" required><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
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
