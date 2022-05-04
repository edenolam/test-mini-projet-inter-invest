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
     * @ORM\Column(type="datetime")
     */
    private $dateImmatriculation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $capital;

    /**
     * @ORM\OneToMany(targetEntity=Adresse::class, mappedBy="societeHistorique")
     */
    private $adresses;

    /**
     * @ORM\OneToOne(targetEntity=FormeJuridique::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $formJuridique;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_changement_immatriculation;

    /**
     * @ORM\ManyToOne(targetEntity=Societe::class, inversedBy="historiques")
     */
    private $societe;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
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

    public function getDateImmatriculation(): ?\DateTimeInterface
    {
        return $this->dateImmatriculation;
    }

    public function setDateImmatriculation(\DateTimeInterface $dateImmatriculation): self
    {
        $this->dateImmatriculation = $dateImmatriculation;

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

    /**
     * @return Collection<int, Adresse>
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->setSocieteHistorique($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getSocieteHistorique() === $this) {
                $adress->setSocieteHistorique(null);
            }
        }

        return $this;
    }

    public function getFormJuridique(): ?FormeJuridique
    {
        return $this->formJuridique;
    }

    public function setFormJuridique(FormeJuridique $formJuridique): self
    {
        $this->formJuridique = $formJuridique;

        return $this;
    }

    public function getDateChangementImmatriculation(): ?\DateTimeInterface
    {
        return $this->date_changement_immatriculation;
    }

    public function setDateChangementImmatriculation(?\DateTimeInterface $date_changement_immatriculation): self
    {
        $this->date_changement_immatriculation = $date_changement_immatriculation;

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

}
