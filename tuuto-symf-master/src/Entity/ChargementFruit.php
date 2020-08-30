<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChargementFruit
 *
 * @ORM\Table(name="chargement_fruit", indexes={@ORM\Index(name="fk_chargement_fruit_chargement1_idx", columns={"chargement"}), @ORM\Index(name="fk_chargement_fruit_fruit1_idx", columns={"fruit"})})
 * @ORM\Entity
 */
class ChargementFruit
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
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var \Chargement
     *
     * @ORM\ManyToOne(targetEntity="Chargement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chargement", referencedColumnName="id")
     * })
     */
    private $chargement;

    /**
     * @var \Fruit
     *
     * @ORM\ManyToOne(targetEntity="Fruit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fruit", referencedColumnName="id")
     * })
     */
    private $fruit;

    public function getId()
    {
        return $this->id;
    }

    public function getQuantite()
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getChargement()
    {
        return $this->chargement;
    }

    public function setChargement($chargement): self
    {
        $this->chargement = $chargement;

        return $this;
    }

    public function getFruit()
    {
        return $this->fruit;
    }

    public function setFruit($fruit): self
    {
        $this->fruit = $fruit;

        return $this;
    }


}
