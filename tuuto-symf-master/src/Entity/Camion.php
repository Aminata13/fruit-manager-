<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Camion
 *
 * @ORM\Table(name="camion")
 * @ORM\Entity
 */
class Camion
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
     * @ORM\Column(name="matricule", type="string", length=45, nullable=false)
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=45, nullable=false)
     */
    private $marque;

    /**
     * @var string|null
     *
     * @ORM\Column(name="couleur", type="string", length=45, nullable=true)
     */
    private $couleur;

    /**
     * @var int
     *
     * @ORM\Column(name="capacite_en_kg", type="integer", nullable=false)
     */
    private $capaciteEnKg;

    public function getId()
    {
        return $this->id;
    }

    public function getMatricule()
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getMarque()
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getCouleur()
    {
        return $this->couleur;
    }

    public function setCouleur($couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getCapaciteEnKg()
    {
        return $this->capaciteEnKg;
    }

    public function setCapaciteEnKg(int $capaciteEnKg): self
    {
        $this->capaciteEnKg = $capaciteEnKg;

        return $this;
    }


}
