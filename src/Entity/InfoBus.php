<?php

namespace App\Entity;

use App\Repository\InfoBusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InfoBusRepository::class)]
class InfoBus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $hotel = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $hour = null;

    #[ORM\ManyToOne(inversedBy: 'infoBuses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LieuDeRdv $location = null;

    #[ORM\OneToMany(mappedBy: 'bus', targetEntity: InfosClient::class)]
    private Collection $infosClients;

    public function __construct()
    {
        $this->infosClients = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHotel(): ?string
    {
        return $this->hotel;
    }

    public function setHotel(string $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }

    public function getHour(): ?\DateTimeInterface
    {
        return $this->hour;
    }

    public function setHour(\DateTimeInterface $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    public function getLocation(): ?LieuDeRdv
    {
        return $this->location;
    }

    public function setLocation(?LieuDeRdv $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection<int, InfosClient>
     */
    public function getInfosClients(): Collection
    {
        return $this->infosClients;
    }

    public function addInfosClient(InfosClient $infosClient): self
    {
        if (!$this->infosClients->contains($infosClient)) {
            $this->infosClients->add($infosClient);
            $infosClient->setBus($this);
        }

        return $this;
    }

    public function removeInfosClient(InfosClient $infosClient): self
    {
        if ($this->infosClients->removeElement($infosClient)) {
            // set the owning side to null (unless already changed)
            if ($infosClient->getBus() === $this) {
                $infosClient->setBus(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->hotel;
    }

    public function __dateToString()
    {
        return  $this->getHour()->format('H:i:s');
    }

    public function getHotelAndHour()
    {
        return ucfirst(strtolower($this->getHotel())) .' - '. $this->getHour()->format('H:i');
    }

}
