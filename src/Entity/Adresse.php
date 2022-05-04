<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdresseRepository::class)
 */
class Adresse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeVoie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomVoie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $codePostale;

    /**
     * @ORM\ManyToOne(targetEntity=Societe::class, inversedBy="adresses", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $societe;

    /**
     * @ORM\ManyToOne(targetEntity=SocieteHistorique::class, inversedBy="adresses")
     */
    private $societeHistorique;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getTypeVoie(): ?string
    {
        return $this->typeVoie;
    }

    public function setTypeVoie(string $typeVoie): self
    {
        $this->typeVoie = $typeVoie;

        return $this;
    }

    public function getNomVoie(): ?string
    {
        return $this->nomVoie;
    }

    public function setNomVoie(string $nomVoie): self
    {
        $this->nomVoie = $nomVoie;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostale(): ?string
    {
        return $this->codePostale;
    }

    public function setCodePostale(string $codePostale): self
    {
        $this->codePostale = $codePostale;

        return $this;
    }

    public function getSociete(): ?Societe
    {
        return $this->societe;
    }

    public function setSociete(?Societe $societe): self
    {
        $this->societe = $societe;

        return $this;
    }

    public function getSocieteHistorique(): ?SocieteHistorique
    {
        return $this->societeHistorique;
    }

    public function setSocieteHistorique(?SocieteHistorique $societeHistorique): self
    {
        $this->societeHistorique = $societeHistorique;

        return $this;
    }
}
