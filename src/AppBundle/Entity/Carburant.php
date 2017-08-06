<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carburant
 *
 * @ORM\Table(name="carburant")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarburantRepository")
 */
class Carburant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateBon", type="date")
     */
    private $dateBon;

    /**
     * @var int
     *
     * @ORM\Column(name="kilometrage", type="bigint")
     */
    private $kilometrage;

    /**
     * @var float
     *
     * @ORM\Column(name="litre", type="float")
     */
    private $litre;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float")
     */
    private $montant;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Vehicule",inversedBy="carburants")
     */
    private $vehicule;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateBon
     *
     * @param \DateTime $dateBon
     *
     * @return Carburant
     */
    public function setDateBon($dateBon)
    {
        $this->dateBon = $dateBon;

        return $this;
    }

    /**
     * Get dateBon
     *
     * @return \DateTime
     */
    public function getDateBon()
    {
        return $this->dateBon;
    }

    /**
     * Set kilometrage
     *
     * @param integer $kilometrage
     *
     * @return Carburant
     */
    public function setKilometrage($kilometrage)
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    /**
     * Get kilometrage
     *
     * @return int
     */
    public function getKilometrage()
    {
        return $this->kilometrage;
    }

    /**
     * Set litre
     *
     * @param float $litre
     *
     * @return Carburant
     */
    public function setLitre($litre)
    {
        $this->litre = $litre;

        return $this;
    }

    /**
     * Get litre
     *
     * @return float
     */
    public function getLitre()
    {
        return $this->litre;
    }

    /**
     * Set montant
     *
     * @param float $montant
     *
     * @return Carburant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set vehicule
     *
     * @param \AppBundle\Entity\Vehicule $vehicule
     *
     * @return Carburant
     */
    public function setVehicule(\AppBundle\Entity\Vehicule $vehicule = null)
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    /**
     * Get vehicule
     *
     * @return \AppBundle\Entity\Vehicule
     */
    public function getVehicule()
    {
        return $this->vehicule;
    }
}
