<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VisiteTechnique
 *
 * @ORM\Table(name="permis_circulation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PermisCirculationRepository")
 */
class PermisCirculation
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
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="prochaineDate", type="datetime")
     */
    private $prochaineDate;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Vehicule",inversedBy="permisCirculations")
     */
    private $vehicule;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Remorque",inversedBy="permisCirculations")
     */
    private $remorque;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return PermisCirculation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set prochaineDate
     *
     * @param \DateTime $prochaineDate
     *
     * @return PermisCirculation
     */
    public function setProchaineDate($prochaineDate)
    {
        $this->prochaineDate = $prochaineDate;

        return $this;
    }

    /**
     * Get prochaineDate
     *
     * @return \DateTime
     */
    public function getProchaineDate()
    {
        return $this->prochaineDate;
    }

    /**
     * Set vehicule
     *
     * @param \AppBundle\Entity\Vehicule $vehicule
     *
     * @return PermisCirculation
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

    /**
     * Set remorque
     *
     * @param \AppBundle\Entity\Remorque $remorque
     *
     * @return PermisCirculation
     */
    public function setRemorque(\AppBundle\Entity\Remorque $remorque = null)
    {
        $this->remorque = $remorque;

        return $this;
    }

    /**
     * Get remorque
     *
     * @return \AppBundle\Entity\Remorque
     */
    public function getRemorque()
    {
        return $this->remorque;
    }
}
