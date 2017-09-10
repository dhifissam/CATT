<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Remorque
 *
 * @ORM\Table(name="remorque")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RemorqueRepository")
 */
class Remorque
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
     * @ORM\Column(name="dateCirculation", type="date")
     */
    private $dateCirculation;

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
     * @ORM\Column(name="numChassit", type="string", length=255)
     */
    private $numChassit;

    /**
     * @ORM\Column(name="enable", type="boolean")
     */
    private $enable;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Entretient",mappedBy="remorque")
     * @ORM\OrderBy({"dateEntretient" ="DESC"})
     */
    private $entretients;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\VisiteTechnique",mappedBy="remorque")
     * @ORM\OrderBy({"date" ="DESC"})
     */
    private $visitesTechniques;



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
     * Set dateCirculation
     *
     * @param \DateTime $dateCirculation
     *
     * @return Remorque
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
     * Set matricule
     *
     * @param string $matricule
     *
     * @return Remorque
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
     * Set numChassit
     *
     * @param string $numChassit
     *
     * @return Remorque
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
     * Set enable
     *
     * @param boolean $enable
     *
     * @return Remorque
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
     * Constructor
     */
    public function __construct()
    {
        $this->enable=true;
         $this->entretients = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public  function  __toString()
    {
        return $this->matricule;
    }



    /**
     * Add entretient
     *
     * @param \AppBundle\Entity\Entretient $entretient
     *
     * @return Remorque
     */
    public function addEntretient(\AppBundle\Entity\Entretient $entretient)
    {
        $this->entretients[] = $entretient;

        return $this;
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
     * Remove entretient
     *
     * @param \AppBundle\Entity\Entretient $entretient
     */
    public function removeEntretient(\AppBundle\Entity\Entretient $entretient)
    {
        $this->entretients->removeElement($entretient);
    }




    /**
     * Set marque
     *
     * @param \AppBundle\Entity\Marque $marque
     *
     * @return Remorque
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
     * Add visitesTechnique
     *
     * @param \AppBundle\Entity\VisiteTechnique $visitesTechnique
     *
     * @return Remorque
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
}
