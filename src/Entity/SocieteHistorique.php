<?php

namespace App\Entity;

use App\Repository\SocieteHistoriqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SocieteHistoriqueRepository::class)
 */
class SocieteHistorique
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=9)
     */
    private $siren;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villeImmatriculation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $capital;

    /**
     * @ORM\ManyToOne(targetEntity=Societe::class, inversedBy="historiques")
     */
    private $societe;

    /**
     * @ORM\OneToMany(targetEntity=AdresseHistorique::class, mappedBy="societeHistorique")
     */
    private $adresseHistoriques;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=FormeJuridique::class, inversedBy="societeHistoriques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formJuridique;

    public function __construct()
    {
        $this->adresseHistoriques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getVilleImmatriculation(): ?string
    {
        return $this->villeImmatriculation;
    }

    public function setVilleImmatriculation(string $villeImmatriculation): self
    {
        $this->villeImmatriculation = $villeImmatriculation;

        return $this;
    }

    public function getCapital(): ?string
    {
        return $this->capital;
    }

    public function setCapital(string $capital): self
    {
        $this->capital = $capital;

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

    /**
     * @return Collection<int, AdresseHistorique>
     */
    public function getAdresseHistoriques(): Collection
    {
        return $this->adresseHistoriques;
    }

    public function addAdresseHistorique(AdresseHistorique $adresseHistorique): self
    {
        if (!$this->adresseHistoriques->contains($adresseHistorique)) {
            $this->adresseHistoriques[] = $adresseHistorique;
            $adresseHistorique->setSocieteHistorique($this);
        }

        return $this;
    }

    public function removeAdresseHistorique(AdresseHistorique $adresseHistorique): self
    {
        if ($this->adresseHistoriques->removeElement($adresseHistorique)) {
            // set the owning side to null (unless already changed)
            if ($adresseHistorique->getSocieteHistorique() === $this) {
                $adresseHistorique->setSocieteHistorique(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getFormJuridique(): ?FormeJuridique
    {
        return $this->formJuridique;
    }

    public function setFormJuridique(?FormeJuridique $formJuridique): self
    {
        $this->formJuridique = $formJuridique;

        return $this;
    }

}
