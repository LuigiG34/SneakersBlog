<?php

namespace LuigiG34\App\Controllers;

use LuigiG34\App\Models\CommentaireManager;

class CommentaireController
{

    private $commentaireManager;

    public function __construct()
    {
        $this->commentaireManager = new CommentaireManager();
    }

    public function addCommentaire($id)
    {
        if (isset($_SESSION['user'])) {
            if (!empty($_POST['commentaire'])) {
                $this->commentaireManager->addCommentaireDB($_POST['commentaire'], $id, $_SESSION['user']['id']);
                GlobalController::alert('success', "Le commentaire a été rajouté !");
                header('Location: ' . URL . 'articles/' . $id);
                exit;
            } else {
                GlobalController::alert('error', "Les champs sont vides");
                header('Location: ' . URL . 'articles/' . $id);
                exit;
            }
        }
    }

    public function deleteCommentaire($id, $id_article)
    {
        if ($_SESSION['user']['role'] == "admin") {
            if (isset($_POST['delete'])) {
                $this->commentaireManager->deleteCommentaireDB($id);
                GlobalController::alert('success', "Le commentaire a été supprimé !");
                header('Location: ' . URL . 'articles/' . $id_article);
                exit;
            }
        } else {
            GlobalController::alert('error', "Vous n'avez pas l'autorisation !");
            header('Location: ' . URL . 'articles/' . $id_article);
            exit;
        }
    }
}
