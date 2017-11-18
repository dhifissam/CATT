<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pointage
 *
 * @ORM\Table(name="pointage")
 * @UniqueEntity(
 *     fields={"chauffeur", "date"},
 *     errorPath="date",
 *     message="Vous avez fait ce pointage pour ce chauffeur"
 * )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PointageRepository")
 */
class Pointage
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
     * @var int
     *
     * @ORM\Column(name="date_pointage", type="date")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="montantDejeuner", type="integer")
     */
    private $montantDejeuner;

    /**
     * @var int
     *
     * @ORM\Column(name="monatantDinee", type="integer")
     */
    private $monatantDinee;

    /**
     * @var int
     *
     * @ORM\Column(name="montantNuitee", type="integer")
     */
    private $montantNuitee;

    /**
     * @var float
     *
     * @ORM\Column(name="heureSupp50", type="float")
     */
    private $heureSupp50;

    /**
     * @var float
     *
     * @ORM\Column(name="heureSupp75", type="float")
     */
    private $heureSupp75;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Chauffeur")
     */
    private $chauffeur;

    public function __construct()
    {
        $this->date= new \DateTime();
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Pointage
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
     * Set montantDejeuner
     *
     * @param integer $montantDejeuner
     *
     * @return Pointage
     */
    public function setMontantDejeuner($montantDejeuner)
    {
        $this->montantDejeuner = $montantDejeuner;

        return $this;
    }

    /**
     * Get montantDejeuner
     *
     * @return integer
     */
    public function getMontantDejeuner()
    {
        return $this->montantDejeuner;
    }

    /**
     * Set monatantDinee
     *
     * @param integer $monatantDinee
     *
     * @return Pointage
     */
    public function setMonatantDinee($monatantDinee)
    {
        $this->monatantDinee = $monatantDinee;

        return $this;
    }

    /**
     * Get monatantDinee
     *
     * @return integer
     */
    public function getMonatantDinee()
    {
        return $this->monatantDinee;
    }

    /**
     * Set montantNuitee
     *
     * @param integer $montantNuitee
     *
     * @return Pointage
     */
    public function setMontantNuitee($montantNuitee)
    {
        $this->montantNuitee = $montantNuitee;

        return $this;
    }

    /**
     * Get montantNuitee
     *
     * @return integer
     */
    public function getMontantNuitee()
    {
        return $this->montantNuitee;
    }

    /**
     * Set heureSupp50
     *
     * @param float $heureSupp50
     *
     * @return Pointage
     */
    public function setHeureSupp50($heureSupp50)
    {
        $this->heureSupp50 = $heureSupp50;

        return $this;
    }

    /**
     * Get heureSupp50
     *
     * @return float
     */
    public function getHeureSupp50()
    {
        return $this->heureSupp50;
    }

    /**
     * Set heureSupp75
     *
     * @param float $heureSupp75
     *
     * @return Pointage
     */
    public function setHeureSupp75($heureSupp75)
    {
        $this->heureSupp75 = $heureSupp75;

        return $this;
    }

    /**
     * Get heureSupp75
     *
     * @return float
     */
    public function getHeureSupp75()
    {
        return $this->heureSupp75;
    }

    /**
     * Set chauffeur
     *
     * @param \AppBundle\Entity\Chauffeur $chauffeur
     *
     * @return Pointage
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
}
