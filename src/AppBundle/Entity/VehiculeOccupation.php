<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VehiculeOccupation
 *
 * @ORM\Table(name="vehicule_occupation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VehiculeOccupationRepository")
 */
class VehiculeOccupation
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
     * @ORM\Column(name="dateOccupation", type="date")
     */
    private $dateOccupation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateOccupationFin", type="date" ,nullable=true)
     */
    private $dateOccupationFin;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Chauffeur")
     */
    private $chauffeur;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Vehicule",inversedBy="vehiculeOccupations")
     */
    private $vehicule;

    public function __construct()
    {
        //$this->dateOccupation= new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateOccupation
     *
     * @param \DateTime $dateOccupation
     *
     * @return VehiculeOccupation
     */
    public function setDateOccupation($dateOccupation)
    {
        $this->dateOccupation = $dateOccupation;

        return $this;
    }

    /**
     * Get dateOccupation
     *
     * @return \DateTime
     */
    public function getDateOccupation()
    {
        return $this->dateOccupation;
    }

    /**
     * Set dateOccupationFin
     *
     * @param \DateTime $dateOccupationFin
     *
     * @return VehiculeOccupation
     */
    public function setDateOccupationFin($dateOccupationFin)
    {
        $this->dateOccupationFin = $dateOccupationFin;

        return $this;
    }

    /**
     * Get dateOccupationFin
     *
     * @return \DateTime
     */
    public function getDateOccupationFin()
    {
        return $this->dateOccupationFin;
    }

    /**
     * Set chauffeur
     *
     * @param \AppBundle\Entity\Chauffeur $chauffeur
     *
     * @return VehiculeOccupation
     */
    public function setChauffeur(\AppBundle\Entity\Chauffeur $chauffeur = null)
    {
        $this->chauffeur = $chauffeur;

        return $this;
    }

    /**
     * Get chauffeur
     *
     * @return \AppBundle\Entity\Chauffeur
     */
    public function getChauffeur()
    {
        return $this->chauffeur;
    }

    /**
     * Set vehicule
     *
     * @param \AppBundle\Entity\Vehicule $vehicule
     *
     * @return VehiculeOccupation
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
