<?php

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\Repository\UserRepository;
use App\Model\Repository\BookRepository;
use App\Model\Entity\User;
use App\Service\UploadService;

class UserController extends AbstractController
{
    public function register()
    {
        $errors = [];
        $targetAction = $_GET['redirect'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $userRepo = new UserRepository();

                // Validation de l'email
                // if ($_POST['password'] !== $_POST['password_confirm']) {
                //     $errors[] = "Les mots de passe ne correspondent pas.";
                // }

                // Vérification email unique
                if ($userRepo->findByEmail($_POST['email'])) {
                    $errors[] = "Cet email est déjà utilisé.";
                }

                // Si pas d'erreurs, on procède à l'inscription
                if (empty($errors)) {
                    $newUser = new User($_POST);

                    $newUser->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));

                    $userRepo->add($newUser);

                    // LOG AUTOMATIQUE
                    $registeredUser = $userRepo->findByEmail($newUser->getEmail());
                    $this->setUserSession($registeredUser);

                    // Redirection dynamique
                    if ($targetAction) {
                        $this->redirect('index.php?action=' . $targetAction);
                    } else {
                        $this->redirect('/');
                    }
                    return;
                }
            } catch (\PDOException $e) {
                $errors[] = "Désolé, un problème technique empêche l'inscription.";
            } catch (\Exception $e) {
                $errors[] = "Une erreur inconnue est survenue.";
            }
        }

        $this->render('auth/register', [
            'title' => 'Inscription',
            'errors' => $errors
        ]);
    }

    public function login()
    {
        // Redirection si déjà connecté
        if (isset($_SESSION['user'])) {
            $this->redirect('/');
        }

        $error = null;
        $targetAction = $_GET['redirect'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userRepo = new UserRepository();
            $user = $userRepo->findByEmail($email);

            if ($user && password_verify($password, $user->getPassword())) {
                $this->setUserSession($user);
                // Redirection dynamique
                if ($targetAction) {
                    $this->redirect('index.php?action=' . $targetAction);
                } else {
                    $this->redirect('/');
                }
                return;
            } else {
                $error = "Identifiants invalides.";
            }
        }

        $this->render('auth/login', [
            'title' => 'Connexion',
            'error' => $error
        ]);
    }

    public function logout()
    {
        $this->destroySession();
        $this->redirect('/');
    }

    /**
     * Affiche le profil de l'utilisateur connecté
     * Action: profile
     */
    public function showProfile()
    {
        // On vérifie que l'utilisateur est bien connecté via isConnected() qui redirigera si besoin
        $this->isConnected();

        // On récupère les données de l'utilisateur depuis le Repo pour avoir l'objet User complet
        $userRepo = new UserRepository();
        $user = $userRepo->findById($this->getSessionUserId());

        // On récupère les livres de l'utilisateur depuis le Repo
        $bookRepo = new BookRepository();
        $AvailableBooks = $bookRepo->findAvailableByUser($user->getId());
        // On compte le nombre de livres
        $bookCount = count($AvailableBooks);

        // Variables pour gérer les erreurs/succès si envoyées par updateProfile
        $error = $_SESSION['error_profile'] ?? null;
        $success = $_SESSION['success_profile'] ?? null;
        unset($_SESSION['error_profile'], $_SESSION['success_profile']);

        $this->render('user/profile', [
            'title' => 'Mon Compte',
            'user' => $user,
            'books' => $AvailableBooks,
            'bookCount' => $bookCount,
            'error' => $error,
            'success' => $success
        ]);
    }

    /**
     * Met à jour le profil de l'utilisateur
     * Action: updateProfile
     */
    public function updateProfile()
    {
        $this->isConnected();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('index.php?action=profile');
        }

        $userRepo = new UserRepository();
        $user = $userRepo->findById($this->getSessionUserId());

        if (!$user) {
            $this->redirect('index.php?action=logout');
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Mise à jour de l'email
        if (!empty($email) && $email !== $user->getEmail()) {
            // Vérifier si l'email existe déjà pour quelqu'un d'autre
            $existingUser = $userRepo->findByEmail($email);
            if ($existingUser && $existingUser->getId() !== $user->getId()) {
                $_SESSION['error_profile'] = "Cet email est déjà utilisé.";
                $this->redirect('index.php?action=profile');
                return;
            }
            $user->setEmail($email);
        }

        // Mise à jour du mot de passe
        if (!empty($password)) {
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
        }

        // Gestion de l'upload de l'avatar
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $uploadService = new UploadService();
            $targetDir = __DIR__ . '/../../public/uploads/avatars';

            try {
                $newFilename = $uploadService->uploadImage($_FILES['avatar'], $targetDir, 'avatar_', $user->getAvatar());
                $user->setAvatar($newFilename);
            } catch (\Exception $e) {
                $_SESSION['error_profile'] = $e->getMessage();
            }
        }

        $userRepo->update($user);

        // Mettre à jour la session utilisateur avec les nouvelles infos
        $this->setUserSession($user);

        // On vérifie s'il y a une erreur d'upload, sinon message de succès
        if (!isset($_SESSION['error_profile'])) {
            $_SESSION['success_profile'] = "Profil mis à jour avec succès.";
        }

        $this->redirect('index.php?action=profile');
    }

    /**
     * Affiche le profil d'un utilisateur tiers
     * Action: publicProfile
     */
    public function showPublicProfile()
    {
        $id = $_GET['id'] ?? null;
        $userRepo = new UserRepository();
        $user = null;

        if ($id) {
            $user = $userRepo->findById((int)$id);
        }

        // Si l'utilisateur n'existe pas, on lance une erreur
        if (!$user) {
            throw new \Exception("L'utilisateur demandé est introuvable.");
        }

        // On récupère les livres de l'utilisateur depuis le Repo
        $bookRepo = new BookRepository();
        $books = $bookRepo->findByUser($user->getId());
        // On compte le nombre de livres
        $bookCount = count($books);

        $this->render('user/public_profile', [
            'title' => 'Profil de ' . htmlspecialchars($user->getUsername()),
            'user' => $user,
            'books' => $books,
            'bookCount' => $bookCount
        ]);
    }
}
