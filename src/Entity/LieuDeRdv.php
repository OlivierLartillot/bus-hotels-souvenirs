<?php

namespace App\Entity;

use App\Repository\LieuDeRdvRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LieuDeRdvRepository::class)]
class LieuDeRdv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'lieu', targetEntity: InfoBus::class)]
    private Collection $infoBuses;

    public function __construct()
    {
        $this->infoBuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, InfoBus>
     */
    public function getInfoBuses(): Collection
    {
        return $this->infoBuses;
    }

    public function addInfoBus(InfoBus $infoBus): self
    {
        if (!$this->infoBuses->contains($infoBus)) {
            $this->infoBuses->add($infoBus);
            $infoBus->setLocation($this);
        }

        return $this;
    }

    public function removeInfoBus(InfoBus $infoBus): self
    {
        if ($this->infoBuses->removeElement($infoBus)) {
            // set the owning side to null (unless already changed)
            if ($infoBus->getLocation() === $this) {
                $infoBus->setLocation(null);
            }
        }

        return $this;
    }
}
