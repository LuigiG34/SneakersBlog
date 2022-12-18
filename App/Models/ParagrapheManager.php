<?php

namespace LuigiG34\App\Models;
use PDO;

class ParagrapheManager extends DatabaseClass {


    public function addParagrapheDB($contenu_paragraphe, $id_article)
    {
        $sql = "INSERT INTO paragraphe (contenu_paragraphe, id_article) VALUES (:contenu_paragraphe, :id_article)";
        
        $stmt = $this->getDB()->prepare($sql);

        if($stmt->execute([
            ":contenu_paragraphe" => $contenu_paragraphe,
            ":id_article" => $id_article
        ])){
            
            return true;

        } else {
            
            return false;
        
        }
    }

    public function getParagrapheByIdArticle($id_article)
    {
        $sql = "SELECT * FROM paragraphe WHERE id_article = :id_article";

        $stmt = $this->getDB()->prepare($sql);
        
        $stmt->execute([
            ":id_article" => $id_article
        ]);

        $data = $stmt->fetchAll(PDO::FETCH_OBJ);

        if ($data) {

            return $data;
        }else{
 
            return null;
 
        }
    }

    public function updateParagraphe($contenu_paragraphe, $id_article)
    {
        $sql = "UPDATE paragraphe SET contenu_paragraphe = :contenu_paragraphe WHERE id_article = :id_article";

        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute([
            ":contenu_paragraphe" => $contenu_paragraphe,
            ":id_article" => $id_article
        ]);
    }

}