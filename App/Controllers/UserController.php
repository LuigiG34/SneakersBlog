<?php

namespace LuigiG34\App\Controllers;

use LuigiG34\App\Models\UserManager;
use LuigiG34\App\Models\AdresseManager;
use LuigiG34\App\Models\RoleManager;

class UserController
{

    private $userManager;
    private $roleManager;
    private $adresseManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->roleManager = new RoleManager();
        $this->adresseManager = new AdresseManager();
    }

    // se deconnecter
    public function logout()
    {
        session_destroy();
        unset($_SESSION['user']);
        GlobalController::alert('success', "Vous êtes déconnecté !");
        header("Location: " . URL . "home");
        exit;
    }

    // s'inscrire
    public function register()
    {
        if (!empty($_POST['adresse_mail_utilisateur']) && !empty($_POST['ville_utilisateur']) && !empty($_POST['code_postal_utilisateur']) && !empty($_POST['mot_de_passe_utilisateur']) && !empty($_POST['verif_mot_de_passe_utilisateur'])) {

            if ($_POST['mot_de_passe_utilisateur'] == $_POST['verif_mot_de_passe_utilisateur']) {

                // on insère l'adresse en bdd
                $this->adresseManager->addAdresseDB($_POST['ville_utilisateur'], $_POST['code_postal_utilisateur']);

                $hashPassword = password_hash($_POST['mot_de_passe_utilisateur'], PASSWORD_DEFAULT);

                // on récupère l'id de l'adresse
                $id_adresse = $this->adresseManager->getAdresseByVilleAndCode($_POST['ville_utilisateur'], $_POST['code_postal_utilisateur']);

                $result = $this->userManager->addUserDB($_POST['adresse_mail_utilisateur'], $hashPassword, $id_adresse->getId_adresse());

                if ($result) {
                    GlobalController::alert('success', "Inscription effectuée !");
                    header('Location: home');
                    exit;
                    
                } else {
                    GlobalController::alert('error', "Erreur lors de l'inscription !");
                    header('Location: home');
                    exit;
                }
            } else {
                GlobalController::alert('error', "Les mots de passe ne sont pas identiques !");
                header('Location: home');
                exit;
            }
        } else {
            GlobalController::alert('error', "Un ou plusieurs champs sont vides !");
            header('Location: home');
            exit;
        }
    }

    // se connecter
    public function logIn()
    {
        if (!empty($_POST['adresse_mail']) && !empty($_POST['mot_de_passe'])) {

            $user = $this->userManager->getUserByEmail($_POST['adresse_mail']);

            if ($user) {

                if (password_verify($_POST['mot_de_passe'], $user->getMot_de_passe_utilisateur())) {

                    $role = $this->roleManager->getRoleById($user->getId_role());

                    $_SESSION['user'] = [
                        "id" => $user->getId_utilisateur(),
                        "email" => $user->getAdresse_mail_utilisateur(),
                        "role" =>  $role->getNom_role()
                    ];
                    GlobalController::alert('success', "Bonjour " . $_SESSION['user']['email']);
                    header('Location: home');
                    exit;
                } else {
                    GlobalController::alert('error', "Les informations saisies sont incorrect !");
                    header('Location: home');
                    exit;
                }
            } else {
                GlobalController::alert('error', "L'utilisateur est inexistant.");
                header('Location: home');
                exit;
            }
        } else {
            GlobalController::alert('error', 'Un ou plusieurs champs sont vides !');
            header('Location: home');
            exit;
        }
    }

    // visualiser les utilisateur
    public function displayUsers()
    {
        $_SESSION['token_delete'] = bin2hex(random_bytes(32));
        $this->userManager->loadUsers();

        $roleManager = $this->roleManager;
        $adresseManager = $this->adresseManager;
        $users = $this->userManager->getUserArray();
        
        require "Views/administration.php";
    }

    // supprimer un utilisateur
    public function deleteUserDB($id)
    {
        if (isset($_POST['submit']) && $_SESSION['user']['role'] == 'admin') {
            $this->userManager->deleteUser($id);
            GlobalController::alert('success', 'Vous avez supprimé un utilisateur !');
            header("Location: " . URL . "admin");
            exit;
        }
    }
}
