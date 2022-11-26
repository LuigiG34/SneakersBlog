<?php

namespace LuigiG34\App\Models;

use PDO;
use LuigiG34\App\Models\UserClass;

class UserManager extends DatabaseClass {

    /**
     * Tableau dans lequel on stock nos user
     *
     */
    private static $array;

    /**
     * Recuperer un utilisateur par Email
     *
     * @param $adresse_mail_utilisateur
     */
    public function getUserByEmail($adresse_mail_utilisateur) {
        
        $sql = "SELECT * FROM utilisateur WHERE adresse_mail_utilisateur = :adresse_mail_utilisateur";
        
        $stmt = $this->getDB()->prepare($sql);
        
        $stmt->execute([
            ":adresse_mail_utilisateur" => $adresse_mail_utilisateur
        ]);

        $data = $stmt->fetch(PDO::FETCH_OBJ);

        // si l'utilisateur existe on instancie UserClass
        if($data){
            $user = new UserClass();

            $user->setId_utilisateur($data->id_utilisateur);
            $user->setAdresse_mail_utilisateur($data->adresse_mail_utilisateur);
            $user->setMot_de_passe_utilisateur($data->mot_de_passe_utilisateur);
            $user->setId_adresse($data->id_adresse);
            $user->setId_role($data->id_role);

            return $user;
         }else{
             return null;
        }
    }

    /**
     * Ajouter un utilisateur en BDD
     *
     */
    public function addUserDB($adresse_mail_utilisateur, $mot_de_passe_utilisateur, $id_adresse) {

        $sql = "INSERT INTO utilisateur (adresse_mail_utilisateur, mot_de_passe_utilisateur, id_adresse) VALUES (:adresse_mail_utilisateur, :mot_de_passe_utilisateur, :id_adresse)";

        $stmt = $this->getDB()->prepare($sql);
        
        if($stmt->execute([
            ":adresse_mail_utilisateur" => $adresse_mail_utilisateur,
            ":mot_de_passe_utilisateur" => $mot_de_passe_utilisateur,
            ":id_adresse" => $id_adresse
        ])) {
            
            return true;
        
        } else {

            return false;
        
        }
    }

    // On déplace les users dans le tableau
    public static function pushUser($user)
    {
        self::$array[] = $user;
    }

    // on recupere le tableau d'utilisateur
    public static function getUserArray()
    {
        return self::$array;
    }

    // On instancie chaque utilisateur
    public function loadUsers()
    {
        $stmt = $this->getDB()->query('SELECT * FROM utilisateur');
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $key) {
            $this->addUser($key);
        }
    }

    // instancier un utilisateur
    public function addUser($value)
    {
        $user = new UserClass();

        $user->setId_utilisateur($value['id_utilisateur'])
        ->setAdresse_mail_utilisateur($value['adresse_mail_utilisateur'])
        ->setMot_de_passe_utilisateur($value['mot_de_passe_utilisateur'])
        ->setId_adresse($value['id_adresse'])
        ->setId_role($value['id_role']);

        $this->pushUser($user);
    }

    // supprimer un utilisateur via l'id
    public function deleteUser($id) {
        $sql = "DELETE FROM utilisateur WHERE id_utilisateur = :id";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ":id" => $id
        ]);
    }
}