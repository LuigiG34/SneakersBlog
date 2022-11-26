<?php

namespace LuigiG34\App\Models;

class ArticleClass {

    protected $id_article;
    protected $titre_article;
    protected $date_sortie_chaussures;
    protected $url_img_article;
    protected $date_article;

    protected $id_utilisateur;
    protected $id_couleur;


    /**
     * Get the value of titre_article
     */ 
    public function getTitre_article()
    {
        return htmlspecialchars($this->titre_article);
    }

    /**
     * Set the value of titre_article
     *
     * @return  self
     */ 
    public function setTitre_article($titre_article)
    {
        $this->titre_article = $titre_article;

        return $this;
    }

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
     * Get the value of date_sortie_chaussures
     */ 
    public function getDate_sortie_chaussures()
    {
        return htmlspecialchars($this->date_sortie_chaussures);
    }

    public function getDate_sortie_view()
    {
        $date = date_create(htmlspecialchars($this->date_sortie_chaussures));
        return date_format($date, "d/m/Y");
    }

    /**
     * Set the value of date_sortie_chaussures
     *
     * @return  self
     */ 
    public function setDate_sortie_chaussures($date_sortie_chaussures)
    {
        $this->date_sortie_chaussures = $date_sortie_chaussures;

        return $this;
    }

    /**
     * Get the value of url_img_article
     */ 
    public function getUrl_img_article()
    {
        return htmlspecialchars($this->url_img_article);
    }

    /**
     * Set the value of url_img_article
     *
     * @return  self
     */ 
    public function setUrl_img_article($url_img_article)
    {
        $this->url_img_article = $url_img_article;

        return $this;
    }

    /**
     * Get the value of date_article
     */ 
    public function getDate_article()
    {
        return htmlspecialchars($this->date_article);
    }

    public function getDate_article_view()
    {
        $date = date_create(htmlspecialchars($this->date_article));
        return date_format($date, "d/m/Y");
    }

    /**
     * Set the value of date_article
     *
     * @return  self
     */ 
    public function setDate_article($date_article)
    {
        $this->date_article = $date_article;

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
}