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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypeEntretient")
     */
    private $typeEntretient;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="decimal", precision=10, scale=3)
     */
    private $prix  ;

    /**
     * @var string
     *
     * @ORM\Column(name="fournisseur", type="string", length=255)
     */
    private $fournisseur;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="text",nullable=true)
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
     * @return integer
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
     * Set typeEntretient
     *
     * @param \AppBundle\Entity\TypeEntretient $typeEntretient
     *
     * @return Entretient
     */
    public function setTypeEntretient(\AppBundle\Entity\TypeEntretient $typeEntretient = null)
    {
        $this->typeEntretient = $typeEntretient;

        return $this;
    }

    /**
     * Get typeEntretient
     *
     * @return \AppBundle\Entity\TypeEntretient
     */
    public function getTypeEntretient()
    {
        return $this->typeEntretient;
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
     * Set fournisseur
     *
     * @param string $fournisseur
     *
     * @return Entretient
     */
    public function setFournisseur($fournisseur)
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return string
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }


    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Entretient
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer
     */
    public function getPrix()
    {
        return $this->prix;
    }


}
