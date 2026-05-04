<section>
    <div class="container container-sm py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="assets/img/hero-image.jpg"
                    class="d-block mx-lg-auto img-fluid"
                    alt="Bootstrap Themes" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Rejoignez nos lecteurs passionnés</h1>
                <p class="lead">Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres. </p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <button type="button" class="btn btn-primary btn-lg px-4 me-md-2 rounded-2">Découvrir</button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-secondary">
    <div class="container container-sm py-5">
        <h2 class="text-center mb-4">Les derniers livres ajoutés</h2>

        <ul class="row list-unstyled">
            <?php foreach ($books as $book): ?>
                <li class="col-12 col-md-6 col-lg-3 mb-4">
                    <?php include 'partials/_book_card.php'; ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="text-center mt-4">
            <a href="/boutique" class="btn btn-primary btn-lg px-4 rounded-2">Voir tous les livres</a>
        </div>
    </div>
</section>

<section>
    <div class="container container-sm py-5">
        <h2 class="text-center mb-4">Comment ça marche ?</h2>
        <p class="text-center">
            Échanger des livres avec TomTroc c’est simple et <br>
            amusant ! Suivez ces étapes pour commencer :
        </p>

        <ul class="row list-unstyled">
            <li class="col-12 col-md-6 col-lg-3 mb-4">
                <article class="card h-100 shadow-sm p-3">
                    <p class="mb-0 text-break">
                        Inscrivez-vous gratuitement sur notre plateforme.
                    </p>
                </article>
            </li>
            <li class="col-12 col-md-6 col-lg-3 mb-4">
                <article class="card h-100 shadow-sm p-3">
                    <p class="mb-0 text-break">
                        Ajoutez les livres que vous souhaitez échanger à votre profil.
                    </p>
                </article>
            </li>
            <li class="col-12 col-md-6 col-lg-3 mb-4">
                <article class="card h-100 shadow-sm p-3">
                    <p class="mb-0 text-break">
                        Parcourez les livres disponibles chez d'autres membres.
                    </p>
                </article>
            </li>
            <li class="col-12 col-md-6 col-lg-3 mb-4">
                <article class="card h-100 shadow-sm p-3">
                    <p class="mb-0 text-break">
                        Proposez un échange et discutez avec d'autres passionnés de lecture.
                    </p>
                </article>
            </li>
        </ul>

        <div class="text-center mt-4">
            <a href="/boutique" class="btn btn-secondary btn-lg px-4 rounded-2">Voir tous les livres</a>
        </div>
    </div>
</section>

<div class="divider-img" role="img" aria-label="Librairie"></div>

<section>
    <div class="container container-sm py-5">
        <div class="row justify-content-center">
            <div class="class=col-md-8 col-lg-4">
                <h2 class="text-center mb-4">Nos valeurs</h2>
                <p>
                    Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.<br>
                    Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.<br>
                    Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.
                </p>
                <div class="d-flex align-items-center gap-3 mt-4">
                    <p>L’équipe Tom Troc</p>
                    <img src="/assets/icons/Vector2.svg" alt="TomTroc" class="navbar-logo d-inline-block align-text-top">
                </div>
            </div>
        </div>
    </div>
</section>
