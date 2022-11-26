<?php

namespace LuigiG34\App\Models;

class CouleurClass {

    protected $id_couleur;
    protected $nom_couleur;
    

    /**
     * Get the value of id_couleur
     */ 
    public function getId_couleur()
    {
        return htmlspecialchars($this->id_couleur);
    }

    /**
     * Set the value of id_couleur
     *
     * @return  self
     */ 
    public function setId_couleur($id_couleur)
    {
        $this->id_couleur = $id_couleur;

        return $this;
    }

    /**
     * Get the value of nom_couleur
     */ 
    public function getNom_couleur()
    {
        return htmlspecialchars($this->nom_couleur);
    }

    /**
     * Set the value of nom_couleur
     *
     * @return  self
     */ 
    public function setNom_couleur($nom_couleur)
    {
        $this->nom_couleur = $nom_couleur;

        return $this;
    }
}