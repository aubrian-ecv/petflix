<?php

namespace App\Entity;

use App\Repository\PetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PetRepository::class)]
class Pet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $arrivalDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $adoptionDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $controlDate = null;

    #[ORM\Column(nullable: true)]
    private ?int $totalCost = null;

    #[ORM\ManyToOne(inversedBy: 'pets')]
    private ?Adopter $adopter = null;

    #[ORM\ManyToOne(inversedBy: 'pets')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Video $video = null;

    #[ORM\ManyToOne(inversedBy: 'pets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PetType $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(\DateTimeInterface $arrivalDate): static
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    public function getAdoptionDate(): ?\DateTimeInterface
    {
        return $this->adoptionDate;
    }

    public function setAdoptionDate(?\DateTimeInterface $adoptionDate): static
    {
        $this->adoptionDate = $adoptionDate;

        return $this;
    }

    public function getControlDate(): ?\DateTimeInterface
    {
        return $this->controlDate;
    }

    public function setControlDate(?\DateTimeInterface $controlDate): static
    {
        $this->controlDate = $controlDate;

        return $this;
    }

    public function getTotalCost(): ?int
    {
        return $this->totalCost;
    }

    public function setTotalCost(?int $totalCost): static
    {
        $this->totalCost = $totalCost;

        return $this;
    }

    public function getAdopter(): ?Adopter
    {
        return $this->adopter;
    }

    public function setAdopter(?Adopter $adopter): static
    {
        $this->adopter = $adopter;

        return $this;
    }

    public function getVideo(): ?Video
    {
        return $this->video;
    }

    public function setVideo(?Video $video): static
    {
        $this->video = $video;

        return $this;
    }

    public function getType(): ?PetType
    {
        return $this->type;
    }

    public function setType(?PetType $type): static
    {
        $this->type = $type;

        return $this;
    }
}
