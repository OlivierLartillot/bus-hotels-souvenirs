<?php

namespace App\Entity;

use App\Repository\InfoBusRepository;
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

    #[ORM\ManyToOne(inversedBy: 'hotel')]
    private ?InfosClient $infosClient = null;

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

    public function getInfosClient(): ?InfosClient
    {
        return $this->infosClient;
    }

    public function setInfosClient(?InfosClient $infosClient): self
    {
        $this->infosClient = $infosClient;

        return $this;
    }
}
