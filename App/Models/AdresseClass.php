<?php

namespace LuigiG34\App\Models;

class AdresseClass {

    protected $id_adresse;
    protected $ville_adresse;
    protected $code_postal_adresse;
    

    /**
     * Get the value of id_adresse
     */ 
    public function getId_adresse()
    {
        return htmlspecialchars($this->id_adresse);
    }

    /**
     * Set the value of id_adresse
     *
     * @return  self
     */ 
    public function setId_adresse($id_adresse)
    {
        $this->id_adresse = $id_adresse;

        return $this;
    }

    /**
     * Get the value of ville_adresse
     */ 
    public function getVille_adresse()
    {
        return htmlspecialchars($this->ville_adresse);
    }

    /**
     * Set the value of ville_adresse
     *
     * @return  self
     */ 
    public function setVille_adresse($ville_adresse)
    {
        $this->ville_adresse = $ville_adresse;

        return $this;
    }

    /**
     * Get the value of code_postal_adresse
     */ 
    public function getCode_postal_adresse()
    {
        return htmlspecialchars($this->code_postal_adresse);
    }

    /**
     * Set the value of code_postal_adresse
     *
     * @return  self
     */ 
    public function setCode_postal_adresse($code_postal_adresse)
    {
        $this->code_postal_adresse = $code_postal_adresse;

        return $this;
    }
}