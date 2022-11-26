<?php

namespace LuigiG34\App\Models;
use LuigiG34\App\Models\CommentaireClass;
use PDO;

class CommentaireManager extends DatabaseClass{

    // tableau de commentaires
    private static $commentaires;

    // ajouter un commentaires dans le tableau
    public function addCommentaire($commentaire)
    {
        self::$commentaires[] = $commentaire;
    }

    // recuperer le tableau d'article
    public function getCommentaires()
    {
        $this->loadCommentaires();
        return self::$commentaires;
    }

    // récupérer un commentaire via son id
    public function getCommentaireById($id)
    {
        $this->loadCommentaires();
        foreach(self::$commentaires as $commentaire) {
            if($commentaire->getId_commentaire() == $id) {
                return $commentaire;
            }
        }
    }

    // récupérer les commentaire et les instancier pour les mettre dans le tableau
    public function loadCommentaires()
    {
        $sql = "SELECT * FROM commentaire";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $value) {
            $newCommentaire = new CommentaireClass();
            $newCommentaire->setId_commentaire($value['id_commentaire'])
            ->setContenu_commentaire($value['contenu_commentaire'])
            ->setDate_commentaire($value['date_commentaire'])
            ->setId_article($value['id_article'])
            ->setId_utilisateur($value['id_utilisateur']);

            $this->addCommentaire($newCommentaire);
        }
    }

    // ajouter un commentaire en bdd
    public function addCommentaireDB($contenu, $id_article, $id_utilisateur)
    {
        $sql = "INSERT INTO commentaire (contenu_commentaire, id_article, id_utilisateur) VALUES (:contenu, :id_article, :id_utilisateur)";

        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute([
            ":contenu" => $contenu,
            ":id_article" => $id_article,
            ":id_utilisateur" => $id_utilisateur
        ]);
    }

    // supprimer un commentaire via l'id
    public function deleteCommentaireDB($id)
    {
        $sql = "DELETE FROM commentaire WHERE id_commentaire = :id";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ":id" => $id
        ]);

        return $result;
    }
}