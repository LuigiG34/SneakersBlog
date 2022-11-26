<?php

namespace LuigiG34\App\Models;

class RoleClass {

    protected $id_role;
    protected $nom_role;
    

    /**
     * Get the value of id_role
     */ 
    public function getId_role()
    {
        return htmlspecialchars($this->id_role);
    }

    /**
     * Set the value of id_role
     *
     * @return  self
     */ 
    public function setId_role($id_role)
    {
        $this->id_role = $id_role;

        return $this;
    }

    /**
     * Get the value of nom_role
     */ 
    public function getNom_role()
    {
        return htmlspecialchars($this->nom_role);
    }

    /**
     * Set the value of nom_role
     *
     * @return  self
     */ 
    public function setNom_role($nom_role)
    {
        $this->nom_role = $nom_role;

        return $this;
    }
}