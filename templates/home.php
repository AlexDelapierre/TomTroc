<section>
    <div class="container-sm py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-12 col-lg-6">
                <img src="assets/img/hero-image.jpg"
                    class="d-block mx-lg-auto img-fluid mb-1"
                    style="max-height: 75vh; object-fit: cover;"
                    fetchpriority="high"
                    alt="Hamza" width="700" height="500" loading="lazy">
                <div class="text-end small text-secondary">Hamza</div>
            </div>
            <div class="col-lg-6 text-start hero-text-panel">
                <h1 class="mb-3 text-dark">Rejoignez nos lecteurs passionnés</h1>
                <p class="text-dark">Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres. </p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start hero-button">
                    <a href="index.php?action=books" class="btn btn-primary btn-lg">Découvrir</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-secondary">
    <div class="container-md py-5">
        <h2 class="text-center mt-4 mb-5">Les derniers livres ajoutés</h2>
        <ul class="row row-cols-2 row-cols-lg-4 list-unstyled home-list mt-5">
            <?php foreach ($books as $book): ?>
                <li class="col mb-4">
                    <?php include 'partials/_book_card.php'; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="text-center my-4">
            <a href="index.php?action=books" class="btn btn-primary btn-lg">Voir tous les livres</a>
        </div>
    </div>
</section>

<section>
    <div class="container-md py-5">
        <h2 class="text-center my-4">Comment ça marche ?</h2>
        <p class="text-center mb-5">
            Échanger des livres avec TomTroc c’est simple et <br>
            amusant ! Suivez ces étapes pour commencer :
        </p>

        <ul class="row row-cols-1 row-cols-lg-4 list-unstyled home-list justify-content-center">
            <?php
            $steps = [
                "Inscrivez-vous gratuitement sur notre plateforme.",
                "Ajoutez les livres que vous souhaitez échanger à votre profil.",
                "Parcourez les livres disponibles chez d'autres membres.",
                "Proposez un échange et discutez avec d'autres passionnés de lecture."
            ];
            foreach ($steps as $step):
            ?>
                <li class="col mb-4 d-flex justify-content-center">
                    <div class="card bg-white p-5 p-md-3 border-0 align-items-center justify-content-center text-center step-card">
                        <p class="mb-0 text-break fw-bold step-text">
                            <?= $step ?>
                        </p>
                    </div>
                </li>
            <?php
            endforeach;
            ?>
        </ul>

        <div class="text-center mt-4">
            <a href="index.php?action=books" class="btn btn-secondary btn-lg">Voir tous les livres</a>
        </div>
    </div>
</section>

<div class="my-5 home-divider-img" role="img" aria-label="Librairie"></div>

<section class="container-sm pt-4 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="pe-6">
                <h2 class="mb-4">Nos valeurs</h2>
                <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
                <p>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.</p>
                <p> Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <p class="text-xss">L’équipe Tom Troc</p>
                <img src="/assets/icons/Vector2.svg" alt="TomTroc" class="navbar-logo navbar-logo-lg d-inline-block align-text-top ms-auto">
            </div>
        </div>
    </div>
</section>
