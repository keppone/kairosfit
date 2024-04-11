<?php

namespace App\Entity;

use App\Repository\PartnerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: PartnerRepository::class)]
class Partner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Unique]
    #[Assert\Length(min: 5)]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Assert\Length(min: 10, max:300)]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;
    
    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $activate = true;

    #[Assert\Unique]
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commercial_contact = null;

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
}
