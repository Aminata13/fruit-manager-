<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chargement
 *
 * @ORM\Table(name="chargement", indexes={@ORM\Index(name="fk_chargement_camion1_idx", columns={"camion"})})
 * @ORM\Entity
 */
class Chargement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="numero_chargement", type="integer", nullable=false)
     */
    private $numeroChargement;

    /**
     * @var string|null
     *
     * @ORM\Column(name="destination", type="string", length=45, nullable=true)
     */
    private $destination;

    /**
     * @var \Camion
     *
     * @ORM\ManyToOne(targetEntity="Camion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="camion", referencedColumnName="id")
     * })
     */
    private $camion;

    public function getId()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNumeroChargement()
    {
        return $this->numeroChargement;
    }

    public function setNumeroChargement(int $numeroChargement): self
    {
        $this->numeroChargement = $numeroChargement;

        return $this;
    }

    public function getDestination()
    {
        return $this->destination;
    }

    public function setDestination($destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getCamion()
    {
        return $this->camion;
    }

    public function setCamion($camion): self
    {
        $this->camion = $camion;

        return $this;
    }


}
