<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Depot
 *
 * @ORM\Table(name="depot")
 * @ORM\Entity
 */
class Depot
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=45, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=45, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_gardien", type="string", length=145, nullable=false)
     */
    private $nomGardien;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=45, nullable=false)
     */
    private $telephone;

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNomGardien()
    {
        return $this->nomGardien;
    }

    public function setNomGardien(string $nomGardien): self
    {
        $this->nomGardien = $nomGardien;

        return $this;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }


}
