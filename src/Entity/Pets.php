<?php

namespace App\Entity;

use App\Repository\PetsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PetsRepository::class)]
class Pets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $arrival_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $adoption_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $control_date = null;

    #[ORM\ManyToOne(inversedBy: 'pets')]
    private ?Adopters $adopter = null;

    #[ORM\ManyToOne(inversedBy: 'pets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Members $staff = null;

    #[ORM\ManyToOne(inversedBy: 'pets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PetsType $type = null;

    #[ORM\ManyToMany(targetEntity: Videos::class, inversedBy: 'pets')]
    private Collection $videos;

    public function __construct()
    {
        $this->videos = new ArrayCollection();
    }

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
        return $this->arrival_date;
    }

    public function setArrivalDate(\DateTimeInterface $arrival_date): static
    {
        $this->arrival_date = $arrival_date;

        return $this;
    }

    public function getAdoptionDate(): ?\DateTimeInterface
    {
        return $this->adoption_date;
    }

    public function setAdoptionDate(\DateTimeInterface $adoption_date): static
    {
        $this->adoption_date = $adoption_date;

        return $this;
    }

    public function getControlDate(): ?\DateTimeInterface
    {
        return $this->control_date;
    }

    public function setControlDate(\DateTimeInterface $control_date): static
    {
        $this->control_date = $control_date;

        return $this;
    }

    public function getAdopter(): ?Adopters
    {
        return $this->adopter;
    }

    public function setAdopter(?Adopters $adopter): static
    {
        $this->adopter = $adopter;

        return $this;
    }

    public function getStaff(): ?Members
    {
        return $this->staff;
    }

    public function setStaff(?Members $staff): static
    {
        $this->staff = $staff;

        return $this;
    }

    public function getType(): ?PetsType
    {
        return $this->type;
    }

    public function setType(?PetsType $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Videos>
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Videos $video): static
    {
        if (!$this->videos->contains($video)) {
            $this->videos->add($video);
        }

        return $this;
    }

    public function removeVideo(Videos $video): static
    {
        $this->videos->removeElement($video);

        return $this;
    }
}
