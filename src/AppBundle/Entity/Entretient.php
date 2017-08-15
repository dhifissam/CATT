<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entretient
 *
 * @ORM\Table(name="entretient")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EntretientRepository")
 */
class Entretient
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
     * @ORM\Column(name="dateEntretient", type="date")
     */
    private $dateEntretient;

    /**
     * @var string
     *
     * @ORM\Column(name="typeEntretient", type="string", length=255)
     */
    private $typeEntretient;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255)
     */
    private $designation;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Remorque",inversedBy="entretients")
     */
    private $remorque;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Vehicule",inversedBy="entretients")
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
     * Set dateEntretient
     *
     * @param \DateTime $dateEntretient
     *
     * @return Entretient
     */
    public function setDateEntretient($dateEntretient)
    {
        $this->dateEntretient = $dateEntretient;

        return $this;
    }

    /**
     * Get dateEntretient
     *
     * @return \DateTime
     */
    public function getDateEntretient()
    {
        return $this->dateEntretient;
    }

    /**
     * Set typeEntretient
     *
     * @param string $typeEntretient
     *
     * @return Entretient
     */
    public function setTypeEntretient($typeEntretient)
    {
        $this->typeEntretient = $typeEntretient;

        return $this;
    }

    /**
     * Get typeEntretient
     *
     * @return string
     */
    public function getTypeEntretient()
    {
        return $this->typeEntretient;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return Entretient
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set vehicule
     *
     * @param \AppBundle\Entity\Vehicule $vehicule
     *
     * @return Entretient
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
     * @return Entretient
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
