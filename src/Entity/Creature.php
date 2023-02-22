<?php

namespace App\Entity;

use App\Repository\CreatureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CreatureRepository::class)]
class Creature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $CR = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $size = null;

    #[ORM\Column]
    private ?int $AC = null;

    #[ORM\Column]
    private ?int $HP = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $speed = null;

    #[ORM\Column(length: 255)]
    private ?string $alignment = null;

    #[ORM\Column]
    private ?bool $legendary = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCR(): ?float
    {
        return $this->CR;
    }

    public function setCR(float $CR): self
    {
        $this->CR = $CR;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getAC(): ?int
    {
        return $this->AC;
    }

    public function setAC(int $AC): self
    {
        $this->AC = $AC;

        return $this;
    }

    public function getHP(): ?int
    {
        return $this->HP;
    }

    public function setHP(int $HP): self
    {
        $this->HP = $HP;

        return $this;
    }

    public function getSpeed(): ?string
    {
        return $this->speed;
    }

    public function setSpeed(?string $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getAlignment(): ?string
    {
        return $this->alignment;
    }

    public function setAlignment(string $alignment): self
    {
        $this->alignment = $alignment;

        return $this;
    }

    public function isLegendary(): ?bool
    {
        return $this->legendary;
    }

    public function setLegendary(bool $legendary): self
    {
        $this->legendary = $legendary;

        return $this;
    }
}
