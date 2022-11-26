<?php

namespace LuigiG34\App\Controllers;

use Exception;

abstract class GlobalController
{
    /**
     * Traitement de l'image
     *
     * @param $file
     * @param $dir
     */
    static public function addImage($file, $dir)
    {
        if(isset($_POST['valider'])){
            // si le dossier de la dir n'existe pas on le créer
            if(!file_exists($dir)){
                mkdir($dir,0777);
                }
    
                // on recupere l'extension
                $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

                $titre = str_replace(" ", "_",$file['name']);
                $target_file = $dir.$titre;

                // si le fichier est bien une img
                if(!getimagesize($file['tmp_name'])){
                    throw new Exception("Le fichier sélectionné n'est pas une image");
                }
    
                // si l'extension est bien png ou jpg/jpeg
                if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png"){
                    throw new Exception("Le format n'est pas reconnu");
                }
                
                // si l'img n'est pas trop volumineuse
                if($file['size'] > 4194304){
                    throw new Exception("Fichier trop volumineux");
                }
    
                // on créer l'image dans notre fichier
                move_uploaded_file($file['tmp_name'], $target_file);
                $name = $dir.$titre;

                // on retourne le nom de l'img pour la stocker en BDD
                return $name;
            }
    }

    /**
     * Afficher un message après une requete
     *
     * @param $type
     * @param $message
     */
    static public function alert($type, $message)
    {
        $_SESSION['alert'] = [
            "type" => $type,
            "msg" => $message
        ];
        return $_SESSION['alert'];
    }
}
