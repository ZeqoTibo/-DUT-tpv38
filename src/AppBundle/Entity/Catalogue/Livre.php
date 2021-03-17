<?php

namespace AppBundle\Entity\Catalogue;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livre
 *
 * @ORM\Entity
 */
class Livre extends Article
{
    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string")
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="isbn", type="string")
     */
    private $ISBN;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_pages", type="integer")
     */
    private $nbPages;

    /**
     * @var string
     *
     * @ORM\Column(name="date_de_parution", type="string")
     */
    private $dateDeParution;

    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Livre
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set iSBN
     *
     * @param string $iSBN
     *
     * @return Livre
     */
    public function setISBN($iSBN)
    {
        $this->ISBN = $iSBN;

        return $this;
    }

    /**
     * Get iSBN
     *
     * @return string
     */
    public function getISBN()
    {
        return $this->ISBN;
    }

    /**
     * Set nbPages
     *
     * @param integer $nbPages
     *
     * @return Livre
     */
    public function setNbPages($nbPages)
    {
        $this->nbPages = $nbPages;

        return $this;
    }

    /**
     * Get nbPages
     *
     * @return int
     */
    public function getNbPages()
    {
        return $this->nbPages;
    }

    /**
     * Set dateDeParution
     *
     * @param string $dateDeParution
     *
     * @return Livre
     */
    public function setDateDeParution($dateDeParution)
    {
        $this->dateDeParution = $dateDeParution;

        return $this;
    }

    /**
     * Get dateDeParution
     *
     * @return string
     */
    public function getDateDeParution()
    {
        return $this->dateDeParution;
    }
}

