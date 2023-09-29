<?php

namespace App\Entity;

use App\Repository\GoalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GoalRepository::class)]
class Goal
{

    use Trait\IdNameTrait;

    #[ORM\Column]
    private ?bool $isDone = null;

    #[ORM\ManyToOne(inversedBy: 'goals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GoalList $goalList = null;

    public function isIsDone(): ?bool
    {
        return $this->isDone;
    }

    public function setIsDone(bool $isDone): static
    {
        $this->isDone = $isDone;

        return $this;
    }

    public function getGoalList(): ?GoalList
    {
        return $this->goalList;
    }

    public function setGoalList(?GoalList $goalList): static
    {
        $this->goalList = $goalList;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
