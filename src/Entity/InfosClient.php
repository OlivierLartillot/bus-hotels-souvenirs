<?php

namespace App\Entity;

use App\Repository\InfosClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InfosClientRepository::class)]
class InfosClient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'infosClient', targetEntity: InfoBus::class)]
    private Collection $hotel;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $day = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $numberPersons = null;

    #[ORM\Column]
    private ?int $roomNumber = null;

    #[ORM\Column(length: 30)]
    private ?string $whatsAppNumber = null;

    public function __construct()
    {
        $this->hotel = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, InfoBus>
     */
    public function getHotel(): Collection
    {
        return $this->hotel;
    }

    public function addHotel(InfoBus $hotel): self
    {
        if (!$this->hotel->contains($hotel)) {
            $this->hotel->add($hotel);
            $hotel->setInfosClient($this);
        }

        return $this;
    }

    public function removeHotel(InfoBus $hotel): self
    {
        if ($this->hotel->removeElement($hotel)) {
            // set the owning side to null (unless already changed)
            if ($hotel->getInfosClient() === $this) {
                $hotel->setInfosClient(null);
            }
        }

        return $this;
    }

    public function getDay(): ?\DateTimeInterface
    {
        return $this->day;
    }

    public function setDay(\DateTimeInterface $day): self
    {
        $this->day = $day;

        return $this;
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

    public function getNumberPersons(): ?int
    {
        return $this->numberPersons;
    }

    public function setNumberPersons(int $numberPersons): self
    {
        $this->numberPersons = $numberPersons;

        return $this;
    }

    public function getRoomNumber(): ?int
    {
        return $this->roomNumber;
    }

    public function setRoomNumber(int $roomNumber): self
    {
        $this->roomNumber = $roomNumber;

        return $this;
    }

    public function getWhatsAppNumber(): ?string
    {
        return $this->whatsAppNumber;
    }

    public function setWhatsAppNumber(string $whatsAppNumber): self
    {
        $this->whatsAppNumber = $whatsAppNumber;

        return $this;
    }
}
