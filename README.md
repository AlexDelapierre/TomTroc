# Tom Troc - Plateforme d'échange de livres

Bienvenue sur le dépôt de **Tom Troc**, une application web de mise en relation pour l'échange de livres d'occasion entre particuliers.

Ce projet a été développé en **PHP natif** (sans framework ni bibliothèque externe, à l'exception de Bootstrap pour la partie interface graphique) dans le respect de l'architecture **MVC** et des standards de codage **PSR-12**.

## 🚀 Prérequis

Pour faire tourner ce projet sur votre machine, vous aurez besoin de :

- PHP (version 8.2 ou supérieure recommandée)
- MySQL (ou MariaDB)
- Composer (uniquement requis pour l'outil de développement et de formatage de code)

## 🛠️ Procédure de déploiement local

Suivez ces étapes pour installer et lancer le projet sur votre environnement de développement local (WAMP, MAMP, XAMPP ou serveur PHP intégré).

### 1. Installation du projet

Placez les fichiers du projet dans le répertoire de travail de votre serveur local :

Exemples :

- `C:/wamp64/www/TomTroc`
- `htdocs/TomTroc`

### 2. Configuration de la base de données

1. Lancez votre serveur MySQL et ouvrez phpMyAdmin.
2. Créez une base de données nommée `tomtroc`.
3. Importez la structure des tables en exécutant le fichier :

   ```sql
   schema.sql
   ```

   (situé dans le dossier db à la racine du projet)

4. Importez le jeu de données de test en exécutant le fichier :

   ```sql
   data.sql
   ```

   (situé dans le dossier db à la racine du projet)

### 3. Fichier de configuration

À la racine du projet, assurez-vous d'avoir un fichier `config.php`.

Configurez vos identifiants de connexion à la base de données :

- Hôte
- Nom de la base
- Utilisateur
- Mot de passe

> Note : Ce fichier est exclu de Git par sécurité.

### 4. Outils de développement (optionnel)

Pour initialiser l'outil de vérification et de formatage automatique des normes de code (**php-cs-fixer**), exécutez la commande suivante à la racine du projet :

```bash
composer install
```

## 🧪 Identifiants de test

Pour vous éviter d'avoir à créer des comptes manuellement, le fichier `data.sql` génère automatiquement trois profils de test avec le même mot de passe :

| Utilisateur | Adresse Email   | Mot de passe |
| ----------- | --------------- | ------------ |
| Alice       | alice@test.fr   | password123  |
| Bob         | bob@test.fr     | password123  |
| Charlie     | charlie@test.fr | password123  |

Ces profils disposent déjà :

- de livres enregistrés dans leur bibliothèque ;
- d'un historique de messagerie ;

afin de tester l'application immédiatement.

## ⚙️ Normes de qualité (PSR-12)

Le projet intègre un outil de formatage automatique du code.

Pour vérifier la conformité des fichiers à tout moment sans les modifier (mode simulation), lancez la commande suivante dans votre terminal :

```bash
./vendor/bin/php-cs-fixer fix . --rules=@PSR12 --dry-run -v
```
