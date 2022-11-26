<?php

namespace LuigiG34\App\Models;

class ParagrapheClass {

    protected $id_paragraphe;
    protected $contenu_paragraphe;
    
    protected $id_article;


    /**
     * Get the value of id_paragraphe
     */ 
    public function getId_paragraphe()
    {
        return htmlspecialchars($this->id_paragraphe);
    }

    /**
     * Set the value of id_paragraphe
     *
     * @return  self
     */ 
    public function setId_paragraphe($id_paragraphe)
    {
        $this->id_paragraphe = $id_paragraphe;

        return $this;
    }

    /**
     * Get the value of contenu_paragraphe
     */ 
    public function getContenu_paragraphe()
    {
        return htmlspecialchars($this->contenu_paragraphe);
    }

    /**
     * Set the value of contenu_paragraphe
     *
     * @return  self
     */ 
    public function setContenu_paragraphe($contenu_paragraphe)
    {
        $this->contenu_paragraphe = $contenu_paragraphe;

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
}