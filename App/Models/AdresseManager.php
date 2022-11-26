<?php

namespace LuigiG34\App\Models;

use LuigiG34\App\Models\DatabaseClass;
use PDO;

class AdresseManager extends DatabaseClass{

    public function getAdresseByVilleAndCode($ville_adresse, $code_postal_adresse)
    {
        $sql = "SELECT * FROM adresse WHERE ville_adresse = :ville_adresse AND code_postal_adresse = :code_postal_adresse";

        $stmt = $this->getDB()->prepare($sql);
        
        $stmt->execute([
            ":ville_adresse" => $ville_adresse,
            ":code_postal_adresse" => $code_postal_adresse
        ]);

        $data = $stmt->fetch(PDO::FETCH_OBJ);

        if ($data) {
            $adresse = new AdresseClass;

            $adresse->setId_adresse($data->id_adresse);
            $adresse->setVille_adresse($data->ville_adresse);
            $adresse->setCode_postal_adresse($data->code_postal_adresse);

            return $adresse;

        }else{
 
            return null;
 
        }

    }

    public function getAdresseById($id_adresse)
    {
        $sql = "SELECT * FROM adresse WHERE id_adresse = :id_adresse";

        $stmt = $this->getDB()->prepare($sql);
        
        $stmt->execute([
            ":id_adresse" => $id_adresse
        ]);

        $data = $stmt->fetch(PDO::FETCH_OBJ);

        if ($data) {
            $adresse = new AdresseClass;

            $adresse->setId_adresse($data->id_adresse);
            $adresse->setVille_adresse($data->ville_adresse);
            $adresse->setCode_postal_adresse($data->code_postal_adresse);

            return $adresse;

        }else{
 
            return null;
 
        }

    }

    public function addAdresseDB($ville_adresse,$code_postal_adresse)
    {
        if($this->getAdresseByVilleAndCode($ville_adresse,$code_postal_adresse) == null) {
            
            $sql = "INSERT INTO adresse (ville_adresse, code_postal_adresse) VALUES (:ville_adresse, :code_postal_adresse)";

            $stmt = $this->getDB()->prepare($sql);
    
            if($stmt->execute([
                ":ville_adresse" => $ville_adresse,
                ":code_postal_adresse" => $code_postal_adresse
            ])){
                
                return true;
    
            } else {
                
                return false;
            
            }
        }else{
         
            return true;
        
        }
    }

}