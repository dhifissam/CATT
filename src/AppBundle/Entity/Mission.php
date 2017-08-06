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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Chauffeur")
     */
    private $chauffeur;

    public function __construct()
    {

        $this->etat =1;
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
     * Set chauffeur
     *
     * @param \AppBundle\Entity\Chauffeur $chauffeur
     *
     * @return Mission
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
