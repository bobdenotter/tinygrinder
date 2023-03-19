<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\QuestRepository;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestRepository::class)]
class Quest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 1024)]
    private ?string $introduction = null;

    #[ORM\Column(length: 1024)]
    private ?string $travel = null;

    #[ORM\Column(length: 1024)]
    private ?string $location = null;

    #[ORM\Column(length: 1024)]
    private ?string $wrapup = null;

    #[ORM\Column(length: 255)]
    private ?string $number_of_encounters = null;

    #[ORM\Column]
    private ?int $gold = null;

    #[ORM\OneToMany(mappedBy: 'quest', targetEntity: Encounter::class)]
    private Collection $Encounter;

    #[ORM\Column(type: Types::ARRAY)]
    private array $treasure = [];

    #[ORM\Column]
    private ?int $CR = null;

    public function __construct()
    {
        $this->Encounter = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        $this->updateSlug();

        return $this;
    }

    public function getIntroduction(): ?string
    {
        return $this->introduction;
    }

    public function setIntroduction(string $introduction): self
    {
        $this->introduction = $introduction;

        return $this;
    }

    public function getTravel(): ?string
    {
        return $this->travel;
    }

    public function setTravel(string $travel): self
    {
        $this->travel = $travel;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getWrapup(): ?string
    {
        return $this->wrapup;
    }

    public function setWrapup(string $wrapup): self
    {
        $this->wrapup = $wrapup;

        return $this;
    }

    public function getNumberOfEncounters(): ?string
    {
        return $this->number_of_encounters;
    }

    public function setNumberOfEncounters(string $number_of_encounters): self
    {
        $this->number_of_encounters = $number_of_encounters;

        return $this;
    }

    public function getGold(): ?int
    {
        return $this->gold;
    }

    public function setGold(int $gold): self
    {
        $this->gold = $gold;

        return $this;
    }

    /**
     * @return Collection<int, Encounter>
     */
    public function getEncounter(): Collection
    {
        return $this->Encounter;
    }

    public function addEncounter(Encounter $encounter): self
    {
        if (!$this->Encounter->contains($encounter)) {
            $this->Encounter->add($encounter);
            $encounter->setQuest($this);
        }

        return $this;
    }

    public function removeEncounter(Encounter $encounter): self
    {
        if ($this->Encounter->removeElement($encounter)) {
            // set the owning side to null (unless already changed)
            if ($encounter->getQuest() === $this) {
                $encounter->setQuest(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = Slugify::create()->slugify($slug);

        return $this;
    }

    #[ORM\PrePersist]
    public function updateSlug(): void
    {
        $this->setSlug($this->getTitle());
    }

    public function getTreasure(): array
    {
        return $this->treasure;
    }

    public function setTreasure(array $treasure): self
    {
        $this->treasure = $treasure;

        return $this;
    }

    public function getCR(): ?int
    {
        return $this->CR;
    }

    public function setCR(int $CR): self
    {
        $this->CR = $CR;

        return $this;
    }
}
