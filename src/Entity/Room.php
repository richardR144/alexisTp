<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $capacity = null;

    #[ORM\ManyToOne(targetEntity: Establishment::class, inversedBy: 'rooms')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Establishment $establishment = null;

    #[ORM\ManyToMany(targetEntity: Tag::class)]
    #[ORM\JoinTable(name: 'room_tag')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Collection $tags;

    #[ORM\OneToMany(mappedBy: 'room', targetEntity: Image::class)]
    private Collection $images;
    #[ORM\Column]
    private ?int $establishment_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
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

    public function getCapacity(): ?string
    {
        return $this->capacity;
    }

    public function setCapacity(string $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getEstablishmentId(): ?int
    {
        return $this->establishment_id;
    }

    public function setEstablishmentId(int $establishment_id): static
    {
        $this->establishment_id = $establishment_id;

        return $this;
    }
}
