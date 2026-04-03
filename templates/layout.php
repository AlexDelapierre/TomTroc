<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'TomTroc' ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <header>
        <nav>
            <a href="/">Accueil</a>
            <a href="/books">Nos livres</a>
        </nav>
    </header>

    <main>
        <?= $content ?> </main>

    <footer>
        <p>&copy; 2024 TomTroc - Échangez vos livres !</p>
    </footer>
</body>

</html>
