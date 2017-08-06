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
     * @ORM\Column(name="dateOccupation", type="datetime")
     */
    private $dateOccupation;

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
        $this->dateOccupation= new \DateTime();
    }


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
