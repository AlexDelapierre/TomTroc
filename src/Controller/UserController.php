<?php

namespace App\Controller;

use App\Core\AbstractController;
use App\Repository\UserRepository;
use App\Model\Entity\User;

class UserController extends AbstractController
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $userRepo = new UserRepository();

                if ($userRepo->findByEmail($_POST['email'])) {
                    return $this->render('auth/register', ['error' => 'Email déjà utilisé.']);
                }

                $newUser = new User(
                    null,
                    $_POST['username'],
                    $_POST['email'],
                    password_hash($_POST['password'], PASSWORD_DEFAULT),
                    null
                );

                $userRepo->add($newUser);

                $this->redirect('/login');
            } catch (\PDOException $e) {
                return $this->render('auth/register', [
                    'error' => "Désolé, un problème technique empêche l'inscription. Réessayez plus tard."
                ]);
            } catch (\Exception $e) {
                return $this->render('auth/register', ['error' => "Une erreur inconnue est survenue."]);
            }
        }

        $this->render('auth/register', ['title' => 'Inscription']);
    }

    public function login()
    {
        if ($this->isConnected()) {
            $this->redirect('/mon-compte');
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userRepo = new UserRepository();
            $user = $userRepo->findByEmail($email);

            if ($user && password_verify($password, $user->getPassword())) {

                $this->setUserSession($user);

                $this->redirect('/mon-compte');
            } else {
                $error = "Identifiants invalides.";
            }
        }

        $this->render('auth/login', [
            'title' => 'Connexion',
            'error' => $error
        ]);
    }
}
