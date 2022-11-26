<?php

namespace LuigiG34\App\Models;

/**
 * Commentaire class
 */
class CommentaireClass {

    protected $id_commentaire;
    protected $contenu_commentaire;
    protected $date_commentaire;
    
    protected $id_utilisateur;
    protected $id_article;


    /**
     * Get the value of id_article
     */ 
    public function getId_article()
    {
        return htmlspecialchars($this->id_article);
    }

    /**
     * Set the value of id_article
     *
     * @return  self
     */ 
    public function setId_article($id_article)
    {
        $this->id_article = $id_article;

        return $this;
    }

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
     * Get the value of date_commentaire
     */ 
    public function getDate_commentaire()
    {
        return htmlspecialchars($this->date_commentaire);
    }

    /**
     * Set the value of date_commentaire
     *
     * @return  self
     */ 
    public function setDate_commentaire($date_commentaire)
    {
        $this->date_commentaire = $date_commentaire;

        return $this;
    }

    /**
     * Get the value of contenu_commentaire
     */ 
    public function getContenu_commentaire()
    {
        return htmlspecialchars($this->contenu_commentaire);
    }

    /**
     * Set the value of contenu_commentaire
     *
     * @return  self
     */ 
    public function setContenu_commentaire($contenu_commentaire)
    {
        $this->contenu_commentaire = $contenu_commentaire;

        return $this;
    }

    /**
     * Get the value of id_commentaire
     */ 
    public function getId_commentaire()
    {
        return htmlspecialchars($this->id_commentaire);
    }

    /**
     * Set the value of id_commentaire
     *
     * @return  self
     */ 
    public function setId_commentaire($id_commentaire)
    {
        $this->id_commentaire = $id_commentaire;

        return $this;
    }
}