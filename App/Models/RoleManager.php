<?php

namespace LuigiG34\App\Models;

use LuigiG34\App\Models\DatabaseClass;
use LuigiG34\App\Models\RoleClass;
use PDO;

class RoleManager extends DatabaseClass {
    
    public function getRoleById($id_role)
    {
        $sql = "SELECT * FROM role WHERE id_role = :id_role";

        $stmt = $this->getDB()->prepare($sql);

        $stmt->execute([
            ':id_role' => $id_role
        ]);

        $data = $stmt->fetch(PDO::FETCH_OBJ);

        if ($data) {
            $role = new RoleClass();

            $role->setId_role($data->id_role);
            $role->setNom_role($data->nom_role);

            return $role;

        }else{
 
            return null;
 
        }
    }

}