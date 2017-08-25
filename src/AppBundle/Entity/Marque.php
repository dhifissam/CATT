<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Marque
 *
 * @ORM\Table(name="marque")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MarqueRepository")
 */
class Marque
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;
    /**
     * @var string
     *
     * @ORM\Column(name="modelle", type="string", length=255)
     */
    private $modelle;


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Marque
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }





    /**
     * Set modelle
     *
     * @param string $modelle
     *
     * @return Marque
     */
    public function setModelle($modelle)
    {
        $this->modelle = $modelle;

        return $this;
    }

    /**
     * Get modelle
     *
     * @return string
     */
    public function getModelle()
    {
        return $this->modelle;
    }
    public function __toString()
    {
        return $this->libelle;
    }
}
