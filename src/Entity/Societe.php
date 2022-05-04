<?php

namespace App\Entity;

use App\Repository\SocieteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SocieteRepository::class)
 */
class Societe
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
     * @ORM\OneToMany(targetEntity=Adresse::class, mappedBy="societe", orphanRemoval=true)
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
     * @ORM\OneToMany(targetEntity=SocieteHistorique::class, mappedBy="societe")
     */
    private $historiques;

    /**
     * @ORM\Column(type="date")
     */
    private $dateImmatriculation;


    public function __construct()
    {
        $this->adresses = new ArrayCollection();
        $this->historiques = new ArrayCollection();
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
            $adress->setSociete($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getSociete() === $this) {
                $adress->setSociete(null);
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


    /**
     * @return Collection<int, SocieteHistorique>
     */
    public function getHistoriques(): Collection
    {
        return $this->historiques;
    }

    public function addHistorique(SocieteHistorique $historique): self
    {
        if (!$this->historiques->contains($historique)) {
            $this->historiques[] = $historique;
            $historique->setSociete($this);
        }

        return $this;
    }

    public function removeHistorique(SocieteHistorique $historique): self
    {
        if ($this->historiques->removeElement($historique)) {
            // set the owning side to null (unless already changed)
            if ($historique->getSociete() === $this) {
                $historique->setSociete(null);
            }
        }

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

}
