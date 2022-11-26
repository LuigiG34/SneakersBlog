<?php

namespace LuigiG34\App\Models;

use PDO;

class ArticleManager extends DatabaseClass {

    // tableau d'articles
    private static $articles;

    // ajouter un article au tableau
    public function addArticle($article)
    {
        self::$articles[] = $article;
    }

    // recuperer le tableau articles
    public function getArticles()
    {
        $this->loadArticles();
        return self::$articles;
    }

    // recuperer un article via l'id
    public function getArticleById($id)
    {
        $this->loadArticles();
        foreach(self::$articles as $article) {
            if($article->getId_article() == $id) {
                return $article;
            }
        }
    }

    // recuperer les articles en bdd et les instancier pour les mettre dans le tableau
    public function loadArticles()
    {
        $sql = "SELECT * FROM article";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $value) {
            $newArticle = new ArticleClass();
            $newArticle->setId_article($value['id_article'])
            ->setTitre_article($value['titre_article'])
            ->setDate_sortie_chaussures($value['date_sortie'])
            ->setUrl_img_article($value['url_image'])
            ->setDate_article($value['date_article'])
            ->setId_utilisateur($value['id_utilisateur'])
            ->setId_couleur($value['id_couleur']);
            $this->addArticle($newArticle);
        }
    }

    public function getArticleByTitre($titre_article)
    {
        $sql = "SELECT * FROM article WHERE titre_article = :titre_article";

        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute([
            ":titre_article" => $titre_article
        ]);

        $data = $stmt->fetch(PDO::FETCH_OBJ);

        if($data){
            return $data->id_article;
        }else{
            return false;
        }
    }

    // ajouter un article en bdd
    public function addArticleDB($titre_article,$date_sortie,$url_image,$id_couleur,$id_utilisateur) {
        $sql = "INSERT INTO article (titre_article, date_sortie, url_image, id_couleur, id_utilisateur) VALUES (:titre_article, :date_sortie, :url_image, :id_couleur, :id_utilisateur)";

        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute([
            ":titre_article" => $titre_article,
            ":date_sortie" => $date_sortie,
            ":url_image" => $url_image,
            ":id_couleur" => $id_couleur,
            ":id_utilisateur" => $id_utilisateur
        ]);
    }

    // mettre à jour un article en bdd
    public function updateArticleDB($titre_article,$date_sortie,$url_image,$id_couleur,$id_article) {
        
        $sql = "UPDATE article SET titre_article = :titre_article, date_sortie = :date_sortie, url_image = :url_image, id_couleur = :id_couleur WHERE id_article = :id_article";

        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute([
            ":titre_article" => $titre_article,
            ":date_sortie" => $date_sortie,
            ":url_image" => $url_image,
            ":id_couleur" => $id_couleur,
            ":id_article" => $id_article
        ]);
    }

    // supprimer un article via l'id
    public function deleteArticle($id)
    {
        $sql = "DELETE FROM article WHERE id_article = :id";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ":id" => $id
        ]);

    }
}