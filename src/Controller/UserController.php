<?php

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\Repository\UserRepository;
use App\Model\Entity\User;

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
                    $newUser = new User(
                        null,
                        $_POST['username'],
                        $_POST['email'],
                        password_hash($_POST['password'], PASSWORD_DEFAULT),
                        null
                    );

                    $userRepo->add($newUser);

                    // LOG AUTOMATIQUE
                    $registeredUser = $userRepo->findByEmail($_POST['email']);
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
        if ($this->isConnected()) {
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
}
