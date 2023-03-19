<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterRepository::class)]
class Character
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\Choice(choices: ['Fighter', 'Thief', 'Magic-User', 'Cleric'])]
    private string $class;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\Choice(choices: ['Human', 'Elf', 'Dwarf', 'Halfling'])]
    private string $species;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $hitpoints = 7;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $max_hitpoints = 7;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $skill_bonus = 1;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $armor_class = 10;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $attack = 1;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $level = 1;

    #[ORM\Column]
    private ?int $XP = 0;

    #[ORM\OneToMany(mappedBy: 'character', targetEntity: Inventory::class, orphanRemoval: true)]
    private Collection $Inventory;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->Inventory = new ArrayCollection();
    }

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

    public function getSpecies(): ?string
    {
        return $this->species;
    }

    public function setSpecies(string $species): self
    {
        $this->species = $species;
        $this->applySpeciesModifier();

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(?string $class): self
    {
        $this->class = $class;
        $this->applyClassModifier();

        return $this;
    }

    public function getSkillBonus(): int
    {
        return $this->skill_bonus;
    }

    public function setSkillBonus(int $skill_bonus): self
    {
        $this->skill_bonus = $skill_bonus;

        return $this;
    }

    public function getHitpoints(): ?int
    {
        return $this->hitpoints;
    }

    public function setHitpoints(int $hitpoints): self
    {
        $this->hitpoints = $hitpoints;

        return $this;
    }

    public function getMaxHitpoints(): ?int
    {
        return $this->max_hitpoints;
    }

    public function setMaxHitpoints(int $max_hitpoints): self
    {
        $this->max_hitpoints = $max_hitpoints;

        return $this;
    }

    public function getTempHP(): ?int
    {
        return $this->tempHP;
    }

    public function setTempHP(int $tempHP): self
    {
        $this->tempHP = $tempHP;

        return $this;
    }

    public function getAttack(): ?int
    {
        return $this->attack;
    }

    public function setAttack(?int $attack): void
    {
        $this->attack = $attack;
    }

    public function getArmorClass(): ?int
    {
        return $this->armor_class;
    }

    public function setArmorClass(int $armor_class): self
    {
        $this->armor_class = $armor_class;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getXP(): ?int
    {
        return $this->XP;
    }

    public function setXP(int $XP): self
    {
        $this->XP = $XP;

        return $this;
    }

    /**
     * @return Collection<int, Inventory>
     */
    public function getInventory(): Collection
    {
        return $this->Inventory;
    }

    public function addInventory(Inventory $inventory): self
    {
        if (!$this->Inventory->contains($inventory)) {
            $this->Inventory->add($inventory);
            $inventory->setCharacter($this);
        }

        return $this;
    }

    public function removeInventory(Inventory $inventory): self
    {
        if ($this->Inventory->removeElement($inventory)) {
            // set the owning side to null (unless already changed)
            if ($inventory->getCharacter() === $this) {
                $inventory->setCharacter(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    private function applyClassModifier(): void
    {
        switch ($this->class) {
            case 'Fighter':
                $this->hitpoints += 1;
                $this->attack += 1;
                break;
            case 'Thief':
                $this->skill_bonus += 1;
                $this->armor_class += 1;
                break;
            case 'Magic-User':
                $this->skill_bonus += 2;
                $this->hitpoints -= 1;
                break;
            case 'Cleric':
                $this->hitpoints += 1;
                $this->skill_bonus += 1;
                break;
        }
    }

    private function applySpeciesModifier(): void
    {
        switch ($this->species) {
            case 'Human':
                break;
            case 'Elf':
                $this->skill_bonus += 1;
                $this->hitpoints -= 1;
                break;
            case 'Dwarf':
                $this->hitpoints += 1;
                $this->skill_bonus -= 1;
                break;
            case 'Halfling':
                $this->armor_class += 1;
                $this->attack -= 1;
                break;
        }
    }
}
