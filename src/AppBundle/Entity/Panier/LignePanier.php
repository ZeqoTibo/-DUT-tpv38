<?php

namespace AppBundle\Entity\Panier;

use Doctrine\ORM\Mapping as ORM;

/**
 * LignePanier
 */
class LignePanier
{
    /**
     * @var Article
     */
    private $article;

    /**
     * @var float
     */
    private $prixUnitaire;

    /**
     * @var float
     */
    private $prixTotal;

    /**
     * @var int
     */
    private $quantite;
	

    /**
     * Set article
     *
     * @param Article $article
     *
     * @return Livre
     */
    public function setArticle($article)
    {
        $this->article = $article;
		$this->prixUnitaire = $article->getPrix();

        return $this;
    }

    /**
     * Get article
     *
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Get prixUnitaire
     *
     * @return float
     */
    public function getPrixUnitaire()
    {
        return $this->prixUnitaire;
    }
	
    /**
     * Get prixTotale
     *
     * @return float
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }
	
   /**
     * Set quatite
     *
     * @param int $quatite
     *
     * @return Livre
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
        $this->recalculer();
        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }
	
    public function recalculer()
    {
        $this->prixTotal = $this->quantite * $this->prixUnitaire ;
    }
}

