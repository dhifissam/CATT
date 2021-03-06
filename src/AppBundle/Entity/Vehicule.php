<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * vehicule
 *
 * @ORM\Table(name="vehicule")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VehiculeRepository")
 */
class Vehicule
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
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=255)
     */
    private $matricule;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Marque")
     */
    private $marque;



    /**
     * @var string
     *
     * @ORM\Column(name="num_chassit", type="string", length=255)
     */
    private $numChassit;



    /**
     * @var string
     *
     * @ORM\Column(name="nbr_cheveaux", type="integer")
     */
    private $nbrCheveaux  ;


    /**
     * @ORM\Column(name="enable", type="boolean")
     */
    private $enable;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\VehiculeOccupation",mappedBy="vehicule")
     * @ORM\OrderBy({"dateOccupation" ="DESC"})
     */
    private $vehiculeOccupations;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Carburant",mappedBy="vehicule")
     * @ORM\OrderBy({"dateBon" ="DESC"})
     */
    private $carburants;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Entretient",mappedBy="vehicule")
     * @ORM\OrderBy({"dateEntretient" ="DESC"})
     */
    private $entretients;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCirculation", type="date")
     */
    private $dateCirculation;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\VisiteTechnique",mappedBy="vehicule")
     * @ORM\OrderBy({"date" ="DESC"})
     */
    private $visitesTechniques;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PermisCirculation",mappedBy="vehicule")
     * @ORM\OrderBy({"date" ="DESC"})
     */
    private $permisCirculations;




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
     * Set matricule
     *
     * @param string $matricule
     *
     * @return Vehicule
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * Get matricule
     *
     * @return string
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set marque
     *
     * @param \AppBundle\Entity\Marque $marque
     *
     * @return Vehicule
     */
    public function setMarque(\AppBundle\Entity\Marque $marque = null)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return \AppBundle\Entity\Marque
     */
    public function getMarque()
    {
        return $this->marque;
    }


    /**
     * Set numChassit
     *
     * @param string $numChassit
     *
     * @return Vehicule
     */
    public function setNumChassit($numChassit)
    {
        $this->numChassit = $numChassit;

        return $this;
    }

    /**
     * Get numChassit
     *
     * @return string
     */
    public function getNumChassit()
    {
        return $this->numChassit;
    }

    /**
     * Set nbrCheveaux
     *
     * @param integer $nbrCheveaux
     *
     * @return Vehicule
     */
    public function setNbrCheveaux($nbrCheveaux)
    {
        $this->nbrCheveaux = $nbrCheveaux;

        return $this;
    }

    /**
     * Get nbrCheveaux
     *
     * @return integer
     */
    public function getNbrCheveaux()
    {
        return $this->nbrCheveaux;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     *
     * @return Vehicule
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return boolean
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Add vehiculeOccupation
     *
     * @param \AppBundle\Entity\VehiculeOccupation $vehiculeOccupation
     *
     * @return Vehicule
     */
    public function addVehiculeOccupation(\AppBundle\Entity\VehiculeOccupation $vehiculeOccupation)
    {
        $this->vehiculeOccupations[] = $vehiculeOccupation;

        return $this;
    }

    /**
     * Remove vehiculeOccupation
     *
     * @param \AppBundle\Entity\VehiculeOccupation $vehiculeOccupation
     */
    public function removeVehiculeOccupation(\AppBundle\Entity\VehiculeOccupation $vehiculeOccupation)
    {
        $this->vehiculeOccupations->removeElement($vehiculeOccupation);
    }

    /**
     * Get vehiculeOccupations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVehiculeOccupations()
    {
        return $this->vehiculeOccupations;
    }

    public function getChauffeur()
    {
       if($this->vehiculeOccupations->count()>0)
           return $this->vehiculeOccupations->first()->getChauffeur();
       return null;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->enable=true;
        $this->vehiculeOccupations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->carburants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->entretients = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public  function  __toString()
    {
        $chauffeur = $this->getChauffeur();
        /**
         * @var  $chauffeur Chauffeur
         */
        if($chauffeur)
            return $this->matricule .' ('.$chauffeur->getNom().' '.$chauffeur->getPrenom().')';
        else
            return $this->matricule;
    }


    /**
     * Add carburant
     *
     * @param \AppBundle\Entity\Carburant $carburant
     *
     * @return Vehicule
     */
    public function addCarburant(\AppBundle\Entity\Carburant $carburant)
    {
        $this->carburants[] = $carburant;

        return $this;
    }


    /**
     * Add entretient
     *
     * @param \AppBundle\Entity\Entretient $entretient
     *
     * @return Vehicule
     */
    public function addEntretient(\AppBundle\Entity\Entretient $entretient)
    {
        $this->entretients[] = $entretient;

        return $this;
    }





    /**
     * Remove carburant
     *
     * @param \AppBundle\Entity\Carburant $carburant
     */
    public function removeCarburant(\AppBundle\Entity\Carburant $carburant)
    {
        $this->carburants->removeElement($carburant);
    }


    /**
     * Remove entretient
     *
     * @param \AppBundle\Entity\Entretient $entretient
     */
    public function removeEntretient(\AppBundle\Entity\Entretient $entretient)
    {
        $this->entretients->removeElement($entretient);
    }





    /**
     * Get carburants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCarburants()
    {
        return $this->carburants;
    }

    /**
     * Get entretients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntretients()
    {
        return $this->entretients;
    }

    /**
     * Set dateCirculation
     *
     * @param \DateTime $dateCirculation
     *
     * @return Vehicule
     */
    public function setDateCirculation($dateCirculation)
    {
        $this->dateCirculation = $dateCirculation;

        return $this;
    }

    /**
     * Get dateCirculation
     *
     * @return \DateTime
     */
    public function getDateCirculation()
    {
        return $this->dateCirculation;
    }


    /**
     * Add visitesTechnique
     *
     * @param \AppBundle\Entity\VisiteTechnique $visitesTechnique
     *
     * @return Vehicule
     */
    public function addVisitesTechnique(\AppBundle\Entity\VisiteTechnique $visitesTechnique)
    {
        $this->visitesTechniques[] = $visitesTechnique;

        return $this;
    }

    /**
     * Remove visitesTechnique
     *
     * @param \AppBundle\Entity\VisiteTechnique $visitesTechnique
     */
    public function removeVisitesTechnique(\AppBundle\Entity\VisiteTechnique $visitesTechnique)
    {
        $this->visitesTechniques->removeElement($visitesTechnique);
    }

    /**
     * Get visitesTechniques
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVisitesTechniques()
    {
        return $this->visitesTechniques;
    }

    /**
     * Add permisCirculation
     *
     * @param \AppBundle\Entity\PermisCirculation $permisCirculation
     *
     * @return Vehicule
     */
    public function addPermisCirculation(\AppBundle\Entity\PermisCirculation $permisCirculation)
    {
        $this->permisCirculations[] = $permisCirculation;

        return $this;
    }

    /**
     * Remove permisCirculation
     *
     * @param \AppBundle\Entity\PermisCirculation $permisCirculation
     */
    public function removePermisCirculation(\AppBundle\Entity\PermisCirculation $permisCirculation)
    {
        $this->permisCirculations->removeElement($permisCirculation);
    }

    /**
     * Get permisCirculations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPermisCirculations()
    {
        return $this->permisCirculations;
    }
}
