<header class="bg-light border-bottom">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container"> <a class="navbar-brand" href="/">
                <img src="/assets/icons/logo.svg" alt="TomTroc" class="navbar-logo d-inline-block align-text-top" height="30">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?action=home">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=books">Nos livres</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    <?php if (isset($_SESSION['user'])): ?>
                        <a href="index.php?action=messages" class="nav-link">Messagerie</a>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?= $_SESSION['user']['avatar'] ?? '/assets/icons/user-default.svg' ?>" alt="Profil" width="32" height="32" class="rounded-circle">
                                <?= htmlspecialchars($_SESSION['user']['username']) ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="index.php?action=profile">Mon profil</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger" href="index.php?action=logout">Déconnexion</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="index.php?action=login" class="btn btn-outline-primary btn-sm">Connexion</a>
                        <a href="index.php?action=register" class="btn btn-primary btn-sm">Inscription</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>
