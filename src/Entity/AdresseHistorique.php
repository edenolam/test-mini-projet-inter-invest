<?php

namespace App\Entity;

use App\Repository\AdresseHistoriqueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdresseHistoriqueRepository::class)
 */
class AdresseHistorique
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
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
     * @ORM\Column(type="string", length=5)
     */
    private $codepostal;

    /**
     * @ORM\ManyToOne(targetEntity=SocieteHistorique::class, inversedBy="adresseHistoriques")
     */
    private $societeHistorique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
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

    public function getCodepostal(): ?string
    {
        return $this->codepostal;
    }

    public function setCodepostal(string $codepostal): self
    {
        $this->codepostal = $codepostal;

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

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }
}
