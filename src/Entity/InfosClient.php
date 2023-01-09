<?php

namespace App\Entity;

use App\Repository\InfosClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: InfosClientRepository::class)]
class InfosClient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\GreaterThanOrEqual('today', null, 'The date must be equal to or greater than today.')]
    private ?\DateTimeInterface $day = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\LessThan(20)]
    private ?int $numberPersons = null;

    #[ORM\Column]
    private ?int $roomNumber = null;

    #[ORM\Column(length: 30)]
    private ?string $whatsAppNumber = null;

    #[ORM\ManyToOne(inversedBy: 'infosClients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?InfoBus $bus = null;

    public function __construct()
    {
        $this->day = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBus(): ?InfoBus
    {
        return $this->bus;
    }

    public function setBus(?InfoBus $bus): self
    {
        $this->bus = $bus;

        return $this;
    }

    #[Assert\Callback]
    public function validate(ExecutionContextInterface $context, $payload)
    {
        // somehow you have an array of "fake names"
        $dayOfWeek = $this->getDay()->format('D');
        $isSunday = false;

        if ($dayOfWeek == "Sun") {
            $isSunday = true;
        }
        
        // check if the name is actually a fake name
        if ($isSunday) {
            $context->buildViolation('You can\'t choose a Sunday !')
                ->atPath('day')
                ->addViolation();
        }
    }
}
