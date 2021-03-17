<?php

namespace AppBundle\Entity\Catalogue;

use Doctrine\ORM\Mapping as ORM;

/**
 * Musique
 *
 * @ORM\Entity
 */
class Piste
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $refPiste;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string")
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string")
     */
    private $url;
	
    /**
     * @ORM\ManyToOne(targetEntity="Musique",cascade={"persist"})
     */
    private $musique;

    /**
     * Set refPiste
     *
     * @param string $refPiste
     *
     * @return Piste
     */
    public function setRefPiste($refPiste)
    {
        $this->refPiste = $refPiste;

        return $this;
    }

    /**
     * Get refPiste
     *
     * @return integer
     */
    public function getRefPiste()
    {
        return $this->refPiste;
    }
	

    /**
     * Set titre
     *
     * @param integer $titre
     *
     * @return Piste
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Piste
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
	

    /**
     * Set musique
     *
     * @param Musique $musique
     *
     * @return Piste
     */
    public function setMusique($musique)
    {
        $this->musique = $musique;

        return $this;
    }

    /**
     * Get musique
     *
     * @return Musique
     */
    public function getMusique()
    {
        return $this->musique;
    }
}

