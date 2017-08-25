<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mission
 *
 * @ORM\Table(name="mission")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MissionRepository")
 */
class Mission
{
    const EN_ATTENTE=1;
    const VALIDEE=2;
    const ANNULEE=3;
    const TERMINEE=4;



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
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="decimal", precision=10, scale=3)
     */
    private $prix;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $validateur;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Depot")
     */
    private $depotChargement;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Depot")
     */
    private $depotDechargement;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Vehicule")
     */
    private $vehicule;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Remorque")
     */
    private $remorque;

    /**
     * @ORM\Column(name="commentaire", type="text",nullable=true)
     */
    private $commentaire;

    public function __construct()
    {
        $this->etat =Mission::EN_ATTENTE;
        $this->dateCreation =new \DateTime();
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
     * Set etat
     *
     * @param integer $etat
     *
     * @return Mission
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return integer
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return Mission
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Mission
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Mission
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Mission
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Mission
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set validateur
     *
     * @param \AppBundle\Entity\User $validateur
     *
     * @return Mission
     */
    public function setValidateur(\AppBundle\Entity\User $validateur = null)
    {
        $this->validateur = $validateur;

        return $this;
    }

    /**
     * Get validateur
     *
     * @return \AppBundle\Entity\User
     */
    public function getValidateur()
    {
        return $this->validateur;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return Mission
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set depotChargement
     *
     * @param \AppBundle\Entity\Depot $depotChargement
     *
     * @return Mission
     */
    public function setDepotChargement(\AppBundle\Entity\Depot $depotChargement = null)
    {
        $this->depotChargement = $depotChargement;

        return $this;
    }

    /**
     * Get depotChargement
     *
     * @return \AppBundle\Entity\Depot
     */
    public function getDepotChargement()
    {
        return $this->depotChargement;
    }

    /**
     * Set depotDechargement
     *
     * @param \AppBundle\Entity\Depot $depotDechargement
     *
     * @return Mission
     */
    public function setDepotDechargement(\AppBundle\Entity\Depot $depotDechargement = null)
    {
        $this->depotDechargement = $depotDechargement;

        return $this;
    }

    /**
     * Get depotDechargement
     *
     * @return \AppBundle\Entity\Depot
     */
    public function getDepotDechargement()
    {
        return $this->depotDechargement;
    }

    /**
     * Set vehicule
     *
     * @param \AppBundle\Entity\Vehicule $vehicule
     *
     * @return Mission
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
     * @return Mission
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

    public function showEtat()
    {
        if($this->etat == Mission::VALIDEE)
            return '<span class="label label-primary" >Validée</span>';
        if($this->etat == Mission::EN_ATTENTE)
            return '<span class="label label-default  " >En attente</span>';
        if($this->etat == Mission::ANNULEE)
            return '<span class="label label-danger" >Annulée</span>';
        if($this->etat == Mission::TERMINEE)
            return '<span class="label label-success" >Terminée</span>';
    }
}
