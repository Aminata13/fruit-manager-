<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fruit
 *
 * @ORM\Table(name="fruit", uniqueConstraints={@ORM\UniqueConstraint(name="nom_UNIQUE", columns={"nom"})}, indexes={@ORM\Index(name="fk_fruit_depot_idx", columns={"depot"})})
 * @ORM\Entity
 */
class Fruit
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
     * @ORM\Column(name="provenance", type="string", length=45, nullable=false)
     */
    private $provenance;

    /**
     * @var int
     *
     * @ORM\Column(name="prix_unitaire", type="integer", nullable=false)
     */
    private $prixUnitaire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="quantite_stock", type="string", length=45, nullable=true)
     */
    private $quantiteStock;

    /**
     * @var \Depot
     *
     * @ORM\ManyToOne(targetEntity="Depot")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="depot", referencedColumnName="id")
     * })
     */
    private $depot;

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

    public function getProvenance()
    {
        return $this->provenance;
    }

    public function setProvenance(string $provenance): self
    {
        $this->provenance = $provenance;

        return $this;
    }

    public function getPrixUnitaire()
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(int $prixUnitaire): self
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    public function getQuantiteStock()
    {
        return $this->quantiteStock;
    }

    public function setQuantiteStock($quantiteStock): self
    {
        $this->quantiteStock = $quantiteStock;

        return $this;
    }

    public function getDepot()
    {
        return $this->depot;
    }

    public function setDepot($depot): self
    {
        $this->depot = $depot;

        return $this;
    }


}
