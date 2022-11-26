<?php

namespace LuigiG34\App\Models;

use PDO;

class CouleurManager extends DatabaseClass{
    
    public function addCouleurDB($nom_couleur)
    {
        if($this->getCouleurByName($nom_couleur) == null) {
            $sql = "INSERT INTO couleur (nom_couleur) VALUES (:nom_couleur)";
        
            $stmt = $this->getDB()->prepare($sql);
    
            $stmt->execute([
                ":nom_couleur" => $nom_couleur
            ]);
        }else{
            return true;
        }
    }

    public function getCouleurByName($nom_couleur)
    {
        $sql = "SELECT * FROM couleur WHERE nom_couleur = :nom_couleur";

        $stmt = $this->getDB()->prepare($sql);
        
        $stmt->execute([
            ":nom_couleur" => $nom_couleur
        ]);

        $data = $stmt->fetch(PDO::FETCH_OBJ);

        if ($data) {
            $couleur = new CouleurClass();

            $couleur->setId_couleur($data->id_couleur);
            $couleur->setNom_couleur($data->nom_couleur);

            return $couleur;

        }else{
 
            return null;
 
        }
    }

    public function getCouleurById($id_couleur)
    {
        $sql = "SELECT * FROM couleur WHERE id_couleur = :id_couleur";

        $stmt = $this->getDB()->prepare($sql);
        
        $stmt->execute([
            ":id_couleur" => $id_couleur
        ]);

        $data = $stmt->fetch(PDO::FETCH_OBJ);

        if ($data) {
            $couleur = new CouleurClass();

            $couleur->setId_couleur($data->id_couleur);
            $couleur->setNom_couleur($data->nom_couleur);

            return $couleur;

        }else{
 
            return null;
 
        }
    }

}