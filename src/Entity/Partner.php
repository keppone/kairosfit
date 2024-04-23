<?php

namespace App\Entity;

use App\Entity\Room;
use Cocur\Slugify\Slugify;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PartnerRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: PartnerRepository::class)]
class Partner
{
    const ACTIVATE =[
        0 => 'Inactif',
        1 => 'Actif'
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 5)]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Assert\Length(min: 10, max:500)]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;
    
    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $activate = true;

    #[Assert\Email]
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commercial_contact = null;

    /**
     * @var Collection<int, Room>
     */
    #[ORM\OneToMany(mappedBy: 'partners', targetEntity: Room::class)]
    private Collection $rooms;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug() :?string
    {
        return (new Slugify())->slugify($this->name); 
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getActivate(): ?bool
    {
        return $this->activate;
    }


    public function setActivate(bool $activate): static
    {
        $this->activate = $activate;

        return $this;
    }

      public function getActivateText(): ?string 
    {
        return self::ACTIVATE[$this->activate]; 
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getCommercialContact(): ?string
    {
        return $this->commercial_contact;
    }

    public function setCommercialContact(?string $commercial_contact): static
    {
        $this->commercial_contact = $commercial_contact;

        return $this;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): static
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms->add($room);
            $room->setPartners($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): static
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getPartners() === $this) {
                $room->setPartners(null);
            }
        }

        return $this;
    }

}
