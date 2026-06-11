<div class="bg-secondary h-100">
    <section class="container-navbar-width pt-5">
        <a href="javascript:history.back()" class="text-decoration-none mb-2 d-inline-block">&lt;- retour</a>
        <h1 class="h3 my-4"><?= htmlspecialchars($title ?? 'Modifier les informations'); ?></h1>
        <form action="index.php?action=<?= $isEdit ? 'editBook&id=' . $book->getId() : 'addBook' ?>"
            method="POST" enctype="multipart/form-data"
            class="blue-form-fields">
            <div class="row py-5 bg-white">

                <div class="col-12 col-lg-6 pe-lg-5">
                    <?php
                    if (!empty($_GET['id'])) {
                        $ImagePath = $book->getImage() ? 'uploads/books/' . htmlspecialchars($book->getImage()) : 'assets/img/default-book.jpg';
                    } else {
                        $ImagePath = 'assets/img/default-book.jpg';
                    }
                    ?>
                    <div class="text-xs mb-1">Photo</div>
                    <img id="book-cover-preview" src="<?= htmlspecialchars($ImagePath) ?>"
                        class="d-block mx-lg-auto img-fluid edit-book-cover image-preview"
                        alt="Image d'illustration"
                        loading="lazy">

                    <div class="mt-3 text-end">
                        <label for="image-book" class="text-decoration-underline text-dark text-xs">Modifier la photo</label>
                        <input class="d-none image-input" type="file" id="image-book" name="image" accept="image/*">
                    </div>
                </div>

                <div class="col-12 col-lg-6 px-5">
                    <?php if (isset($errors) && !empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="mb-4">
                        <label for="title" class="form-label text-xs">Titre</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Titre" value="<?= htmlspecialchars($_POST['title'] ?? ($isEdit ? $book->getTitle() : '')) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="author" class="form-label text-xs">Auteur</label>
                        <input type="text" name="author" id="author" class="form-control" placeholder="Auteur" value="<?= htmlspecialchars($_POST['author'] ?? ($isEdit ? $book->getAuthor() : '')) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label text-xs">Commentaire</label>
                        <textarea
                            name="description"
                            id="description"
                            class="form-control textarea-auto-resize"
                            placeholder="Description"
                            rows="4"
                            maxlength="500"
                            required><?= htmlspecialchars($_POST['description'] ?? ($isEdit ? $book->getDescription() : '')) ?></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="availability" class="form-label text-xs">Disponibilité</label>
                        <select name="is_available" id="availability" class="form-select" required>
                            <?php
                            // 1. On détermine la valeur actuelle (Priorité au POST si erreur, sinon à la BDD, sinon 1 par défaut)
                            $currentAvailability = $_POST['is_available'] ?? ($isEdit ? $book->getIsAvailable() : 1);
                            ?>
                            <option value="1" <?= (intval($currentAvailability) === 1) ? 'selected' : '' ?>>Disponible</option>
                            <option value="0" <?= (intval($currentAvailability) === 0) ? 'selected' : '' ?>>Indisponible</option>
                        </select>
                    </div>
                    <div class="mt-5">
                        <button type="submit" class="btn btn-primary w-75">Valider</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
