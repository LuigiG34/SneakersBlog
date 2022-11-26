<?php

namespace LuigiG34\App\Models;

/**
 * User class
 */
class UserClass {

    protected $id_utilisateur;
    protected $adresse_mail_utilisateur;
    protected $mot_de_passe_utilisateur;

    protected $id_adresse;
    protected $id_role;

    /**
     * Get the value of id_utilisateur
     */ 
    public function getId_utilisateur()
    {
        return htmlspecialchars($this->id_utilisateur);
    }

    /**
     * Set the value of id_utilisateur
     *
     * @return  self
     */ 
    public function setId_utilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    /**
     * Get the value of adresse_mail_utilisateur
     */ 
    public function getAdresse_mail_utilisateur()
    {
        return htmlspecialchars($this->adresse_mail_utilisateur);
    }

    /**
     * Set the value of adresse_mail_utilisateur
     *
     * @return  self
     */ 
    public function setAdresse_mail_utilisateur($adresse_mail_utilisateur)
    {
        $this->adresse_mail_utilisateur = $adresse_mail_utilisateur;

        return $this;
    }

    /**
     * Get the value of mot_de_passe_utilisateur
     */ 
    public function getMot_de_passe_utilisateur()
    {
        return htmlspecialchars($this->mot_de_passe_utilisateur);
    }

    /**
     * Set the value of mot_de_passe_utilisateur
     *
     * @return  self
     */ 
    public function setMot_de_passe_utilisateur($mot_de_passe_utilisateur)
    {
        $this->mot_de_passe_utilisateur = $mot_de_passe_utilisateur;

        return $this;
    }

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
}