<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\EncounterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EncounterRepository::class)]
class Encounter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1024)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $creature = null;

    #[ORM\Column(length: 255)]
    private ?string $amount = null;

    #[ORM\ManyToOne(inversedBy: 'Encounter')]
    private ?Quest $quest = null;

    #[ORM\Column]
    private ?bool $final = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreature(): ?string
    {
        return $this->creature;
    }

    public function setCreature(string $creature): self
    {
        $this->creature = $creature;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getQuest(): ?Quest
    {
        return $this->quest;
    }

    public function setQuest(?Quest $quest): self
    {
        $this->quest = $quest;

        return $this;
    }

    public function isFinal(): ?bool
    {
        return $this->final;
    }

    public function setFinal(bool $final): self
    {
        $this->final = $final;

        return $this;
    }
}
