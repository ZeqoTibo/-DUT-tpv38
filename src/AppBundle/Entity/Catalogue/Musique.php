<?php

namespace AppBundle\Entity\Catalogue;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Musique
 *
 * @ORM\Entity
 */
class Musique extends Article
{
    /**
     * @var string
     *
     * @ORM\Column(name="artiste", type="string")
     */
    private $artiste;

    /**
     * @var string
     *
     * @ORM\Column(name="ean", type="string")
     */
    private $EAN;

    /**
     * @var string
     *
     * @ORM\Column(name="date_de_parution", type="string")
     */
    private $dateDeParution;
	
    /**
     * @ORM\OneToMany(targetEntity="Piste", mappedBy="musique")
     */
    private $pistes;
	
	public function __construct()
	{
		$this->pistes = new ArrayCollection();
	}

    /**
     * Set auteur
     *
     * @param string $artiste
     *
     * @return Musique
     */
    public function setArtiste($artiste)
    {
        $this->artiste = $artiste;

        return $this;
    }

    /**
     * Get artiste
     *
     * @return string
     */
    public function getArtiste()
    {
        return $this->artiste;
    }

    /**
     * Set eAna
     *
     * @param string $eAN
     *
     * @return Musique
     */
    public function setEAN($eAN)
    {
        $this->EAN = $eAN;

        return $this;
    }

    /**
     * Get eAN
     *
     * @return string
     */
    public function getEAN()
    {
        return $this->EAN;
    }

    /**
     * Set dateDeParution
     *
     * @param string $dateDeParution
     *
     * @return Musique
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
	
    /**
     * Get pistes
     *
     * @return array
     */
    public function getpistes()
    {
        return $this->pistes;
    }
	
	public function addPiste($piste)
	{
		$piste->setMusique($this);
		$this->pistes->add($piste);
	}
}

