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

    #[ORM\Column(length: 255)]
    private ?string $race = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $class = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $STR = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $DEX = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $CON = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $INT = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $WIS = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $CHA = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $proficiency = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $speed = null;

    #[ORM\Column]
    private ?int $HP = null;

    #[ORM\Column]
    private ?int $maxHP = null;

    #[ORM\Column]
    private ?int $tempHP = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $initiative = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $AC = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $level = null;

    #[ORM\Column]
    private ?int $XP = null;

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

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(?string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getSTR(): ?int
    {
        return $this->STR;
    }

    public function setSTR(int $STR): self
    {
        $this->STR = $STR;

        return $this;
    }

    public function getDEX(): ?int
    {
        return $this->DEX;
    }

    public function setDEX(int $DEX): self
    {
        $this->DEX = $DEX;

        return $this;
    }

    public function getCON(): ?int
    {
        return $this->CON;
    }

    public function setCON(int $CON): self
    {
        $this->CON = $CON;

        return $this;
    }

    public function getINT(): ?int
    {
        return $this->INT;
    }

    public function setINT(int $INT): self
    {
        $this->INT = $INT;

        return $this;
    }

    public function getWIS(): ?int
    {
        return $this->WIS;
    }

    public function setWIS(int $WIS): self
    {
        $this->WIS = $WIS;

        return $this;
    }

    public function getCHA(): ?int
    {
        return $this->CHA;
    }

    public function setCHA(int $CHA): self
    {
        $this->CHA = $CHA;

        return $this;
    }

    public function getProficiency(): ?int
    {
        return $this->proficiency;
    }

    public function setProficiency(int $proficiency): self
    {
        $this->proficiency = $proficiency;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

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

    public function getMaxHP(): ?int
    {
        return $this->maxHP;
    }

    public function setMaxHP(int $maxHP): self
    {
        $this->maxHP = $maxHP;

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

    public function getInitiative(): ?int
    {
        return $this->initiative;
    }

    public function setInitiative(int $initiative): self
    {
        $this->initiative = $initiative;

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
}
