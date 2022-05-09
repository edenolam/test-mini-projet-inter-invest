<?php

namespace App\Entity;

use App\Repository\FormeJuridiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormeJuridiqueRepository::class)
 */
class FormeJuridique
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
    private $statut;

    /**
     * @ORM\OneToMany(targetEntity=Societe::class, mappedBy="formeJuridique")
     */
    private $societes;

    /**
     * @ORM\OneToMany(targetEntity=SocieteHistorique::class, mappedBy="formJuridique")
     */
    private $societeHistoriques;

    public function __construct()
    {
        $this->societes = new ArrayCollection();
        $this->societeHistoriques = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->statut;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, Societe>
     */
    public function getSocietes(): Collection
    {
        return $this->societes;
    }

    public function addSociete(Societe $societe): self
    {
        if (!$this->societes->contains($societe)) {
            $this->societes[] = $societe;
            $societe->setFormeJuridique($this);
        }

        return $this;
    }

    public function removeSociete(Societe $societe): self
    {
        if ($this->societes->removeElement($societe)) {
            // set the owning side to null (unless already changed)
            if ($societe->getFormeJuridique() === $this) {
                $societe->setFormeJuridique(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SocieteHistorique>
     */
    public function getSocieteHistoriques(): Collection
    {
        return $this->societeHistoriques;
    }

    public function addSocieteHistorique(SocieteHistorique $societeHistorique): self
    {
        if (!$this->societeHistoriques->contains($societeHistorique)) {
            $this->societeHistoriques[] = $societeHistorique;
            $societeHistorique->setFormJuridique($this);
        }

        return $this;
    }

    public function removeSocieteHistorique(SocieteHistorique $societeHistorique): self
    {
        if ($this->societeHistoriques->removeElement($societeHistorique)) {
            // set the owning side to null (unless already changed)
            if ($societeHistorique->getFormJuridique() === $this) {
                $societeHistorique->setFormJuridique(null);
            }
        }

        return $this;
    }
}
