<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Salaire
 *
 * @ORM\Table(name="salaire")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SalaireRepository")
 */
class Salaire
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
     * @var float
     *
     * @ORM\Column(name="montant", type="decimal",precision=7,scale=3)
     */
    private $montant;

    /**
     * @var float
     *
     * @ORM\Column(name="avance", type="decimal",precision=7,scale=3,nullable=true)
     */
    private $avance;

    /**
     * @var int
     *
     * @ORM\Column(name="annee", type="integer")
     */
    private $annee;

    /**
     * @var int
     *
     * @ORM\Column(name="mois", type="integer")
     */
    private $mois;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrJourTravailer", type="integer")
     */
    private $nbrJourTravailer;

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
     * Set montant
     *
     * @param float $montant
     *
     * @return Salaire
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
     * Set nbrJourTravailer
     *
     * @param integer $nbrJourTravailer
     *
     * @return Salaire
     */
    public function setNbrJourTravailer($nbrJourTravailer)
    {
        $this->nbrJourTravailer = $nbrJourTravailer;

        return $this;
    }

    /**
     * Get nbrJourTravailer
     *
     * @return int
     */
    public function getNbrJourTravailer()
    {
        return $this->nbrJourTravailer;
    }

    /**
     * Set montantDejeuner
     *
     * @param integer $montantDejeuner
     *
     * @return Salaire
     */
    public function setMontantDejeuner($montantDejeuner)
    {
        $this->montantDejeuner = $montantDejeuner;

        return $this;
    }

    /**
     * Get montantDejeuner
     *
     * @return int
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
     * @return Salaire
     */
    public function setMonatantDinee($monatantDinee)
    {
        $this->monatantDinee = $monatantDinee;

        return $this;
    }

    /**
     * Get monatantDinee
     *
     * @return int
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
     * @return Salaire
     */
    public function setMontantNuitee($montantNuitee)
    {
        $this->montantNuitee = $montantNuitee;

        return $this;
    }

    /**
     * Get montantNuitee
     *
     * @return int
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
     * @return Salaire
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
     * @return Salaire
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
     * @return Salaire
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
     * Set annee
     *
     * @param integer $annee
     *
     * @return Salaire
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return integer
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set mois
     *
     * @param integer $mois
     *
     * @return Salaire
     */
    public function setMois($mois)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get mois
     *
     * @return integer
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set avance
     *
     * @param string $avance
     *
     * @return Salaire
     */
    public function setAvance($avance)
    {
        $this->avance = $avance;

        return $this;
    }

    /**
     * Get avance
     *
     * @return string
     */
    public function getAvance()
    {
        return $this->avance;
    }
}
