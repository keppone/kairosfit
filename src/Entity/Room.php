<?php

namespace App\Entity;

use App\Entity\Partner;
use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
     const ACTIVATE =[
        0 => 'Inactif',
        1 => 'Actif'
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $postcode = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column]
    private ?bool $activate = null;

    #[ORM\Column]
    private ?bool $mailing = null;

    #[ORM\Column]
    private ?bool $planning = null;

    #[ORM\Column]
    private ?bool $promote = null;

    #[ORM\Column]
    private ?bool $sale = null;

    #[ORM\ManyToOne(inversedBy: 'rooms')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Partner $partners = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): static
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function isActivate(): ?bool
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

    public function isMailing(): ?bool
    {
        return $this->mailing;
    }

    public function setMailing(bool $mailing): static
    {
        $this->mailing = $mailing;

        return $this;
    }

    public function isPlanning(): ?bool
    {
        return $this->planning;
    }

    public function setPlanning(bool $planning): static
    {
        $this->planning = $planning;

        return $this;
    }

    public function isPromote(): ?bool
    {
        return $this->promote;
    }

    public function setPromote(bool $promote): static
    {
        $this->promote = $promote;

        return $this;
    }

    public function isSale(): ?bool
    {
        return $this->sale;
    }

    public function setSale(bool $sale): static
    {
        $this->sale = $sale;

        return $this;
    }

    public function getPartners(): Partner
    {
        return $this->partners;
    }

    public function setPartners(?Partner $partners): static
    {
        $this->partners = $partners;

        return $this;
    }
}
