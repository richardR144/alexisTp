<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $start_time = null;

    #[ORM\Column(length: 255)]
    private ?string $end_time = null;

    #[ORM\Column]
    private ?int $room_id = null;

    #[ORM\Column]
    private ?int $animator_id = null;

    #[ORM\Column]
    private ?int $category_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStartTime(): ?string
    {
        return $this->start_time;
    }

    public function setStartTime(string $start_time): static
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getEndTime(): ?string
    {
        return $this->end_time;
    }

    public function setEndTime(string $end_time): static
    {
        $this->end_time = $end_time;

        return $this;
    }

    public function getRoomId(): ?int
    {
        return $this->room_id;
    }

    public function setRoomId(int $room_id): static
    {
        $this->room_id = $room_id;

        return $this;
    }

    public function getAnimatorId(): ?int
    {
        return $this->animator_id;
    }

    public function setAnimatorId(int $animator_id): static
    {
        $this->animator_id = $animator_id;

        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): static
    {
        $this->category_id = $category_id;

        return $this;
    }
}
