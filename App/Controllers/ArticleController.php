<?php

namespace LuigiG34\App\Controllers;

use LuigiG34\App\Models\ArticleManager;
use LuigiG34\App\Models\CommentaireManager;
use LuigiG34\App\Models\CouleurManager;
use LuigiG34\App\Models\ParagrapheManager;

class ArticleController
{

    private $articleManager;
    private $commentaireManager;
    private $couleurManager;
    private $paragrapheManager;

    public function __construct()
    {
        $this->articleManager = new ArticleManager();
        $this->commentaireManager = new CommentaireManager();
        $this->couleurManager = new CouleurManager();
        $this->paragrapheManager = new ParagrapheManager();
    }

    // visualiser les articles
    public function displayArticles()
    {
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $paragrapheManager = $this->paragrapheManager;
        $articles = $this->articleManager->getArticles();
        require 'Views/articles.php';
    }

    // visualiser 3 derniers articles sur page d'accueil
    public function displayArticlesHome()
    {
        $paragrapheManager = $this->paragrapheManager;
        $articles = $this->articleManager->getArticles();
        require "Views/homepage.php";
    }

    // visualiser un article grace à l'id
    public function displayArticle($id)
    {
        $article = $this->articleManager->getArticleById($id);
        $couleurManager = $this->couleurManager;
        $paragrapheManager = $this->paragrapheManager;
        $commentaires = $this->commentaireManager->getCommentaires();

        if (!$article) {
            http_response_code(404);
            require "Views/404.php";
        } else {
            require 'Views/single-article.php';
        }
    }

    // ajouter un article
    public function addArticle()
    {
        if ($_SESSION['user']['role'] == "admin") {

            if (!empty($_POST['titre']) && !empty($_POST['date']) && !empty($_POST['couleur']) && !empty($_POST['premier']) && !empty($_POST['deuxieme']) && !empty($_FILES['image'])) {

                //traitement img
                $dir = "public/img/shoes/";
                $image = GlobalController::addImage($_FILES['image'], $dir);

                // couleur
                $this->couleurManager->addCouleurDB($_POST['couleur']);
                $id_couleur = $this->couleurManager->getCouleurByName($_POST['couleur']);

                // article
                $this->articleManager->addArticleDB($_POST['titre'], $_POST['date'], $image,  $id_couleur->getId_couleur(), $_SESSION['user']['id']);


                // paragraphe
                $id_article = $this->articleManager->getArticleByTitre($_POST['titre']);
                $paragraphes = [$_POST['premier'],$_POST['deuxieme']];

                foreach($paragraphes as $paragraphe){
                    $this->paragrapheManager->addParagrapheDB($paragraphe, $id_article);
                }

                GlobalController::alert('success', "L'article a été ajouté !");
                header('Location: ' . URL . 'articles');
                exit;
            } else {
                GlobalController::alert('error', "Les champs sont vides !");
                header('Location: ' . URL . 'articles');
                exit;
            }
        } else {
            GlobalController::alert('error', "Vous n'avez pas l'autorisation !");
            header('Location: ' . URL . 'articles');
            exit;
        }
    }

    // supprimer un article via l'id
    public function deleteArticleDB($id)
    {
        if ($_SESSION['user']['role'] == "admin") {
            if ($_SESSION['token']  == $_POST['token']) {
                if (isset($_POST['delete'])) {
                    $image = $this->articleManager->getArticleById($id)->getUrl_img_article();

                    if (file_exists($image)) {
                        unlink($image);
                        $this->articleManager->deleteArticle($id);

                        GlobalController::alert('success', "L'article a été supprimé !");
                        header('Location: ' . URL . 'articles');
                        exit;
                    } else {
                        GlobalController::alert('error', "Le fichier n'existe pas");
                        header('Location: ' . URL . 'articles');
                        exit;
                    }
                }
            } else {
                GlobalController::alert('error', "Les tokens ne sont pas égaux !");
                header('Location: ' . URL . 'articles');
                exit;
            }
        } else {
            GlobalController::alert('error', "Vous n'avez pas l'autorisation !");
            header('Location: ' . URL . 'articles');
            exit;
        }
    }

    // mettre à jour un article 
    public function updateArticle($id)
    {
        if (!empty($_POST['titre']) && !empty($_POST['date']) && !empty($_POST['couleur']) && !empty($_POST['premier']) && !empty($_POST['deuxieme']) && !empty($_FILES['image'])) {

            $image = $this->articleManager->getArticleById($id)->getUrl_img_article();

            // si on upload une nouvelle img alors on supprime l'ancienne
            if ($_FILES['image']['size'] > 0) {
                unlink($image);
                $dir = "public/img/shoes/";
                $newImage = GlobalController::addImage($_FILES['image'], $dir);
            } else {
                // sinon on garde l'ancienne
                $newImage = $image;
            }

            //paragraphe
            $paragraphes = [$_POST['premier'],$_POST['deuxieme']];
            foreach($paragraphes as $paragraphe){
                $this->paragrapheManager->updateParagraphe($paragraphe, $id);
            }

            // couleur
            $this->couleurManager->addCouleurDB($_POST['couleur']);
            $id_couleur = $this->couleurManager->getCouleurByName($_POST['couleur']);

            $this->articleManager->updateArticleDB($_POST['titre'], $_POST['date'],  $newImage, $id_couleur->getId_couleur(),$id);
            GlobalController::alert('success', "L'article a été modifié !");
            header('Location: ' . URL . 'articles');
            exit;
        } else {
            GlobalController::alert('error', "Les champs sont vides !");
            header('Location: ' . URL . 'articles');
            exit;
        }
    }
}
