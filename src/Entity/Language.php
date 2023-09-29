<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    use Trait\IdNameTrait;

    #[ORM\Column(length: 3)]
    private ?string $iso639 = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'languages')]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'language', targetEntity: WordList::class)]
    private Collection $wordLists;

    #[ORM\OneToMany(mappedBy: 'language', targetEntity: GoalList::class)]
    private Collection $goalLists;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->wordLists = new ArrayCollection();
        $this->goalLists = new ArrayCollection();
    }

    public function getIso639(): ?string
    {
        return $this->iso639;
    }

    public function setIso639(string $iso639): static
    {
        $this->iso639 = $iso639;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addLanguage($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeLanguage($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, WordList>
     */
    public function getWordLists(): Collection
    {
        return $this->wordLists;
    }

    public function addWordList(WordList $wordList): static
    {
        if (!$this->wordLists->contains($wordList)) {
            $this->wordLists->add($wordList);
            $wordList->setLanguage($this);
        }

        return $this;
    }

    public function removeWordList(WordList $wordList): static
    {
        if ($this->wordLists->removeElement($wordList)) {
            // set the owning side to null (unless already changed)
            if ($wordList->getLanguage() === $this) {
                $wordList->setLanguage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GoalList>
     */
    public function getGoalLists(): Collection
    {
        return $this->goalLists;
    }

    public function addGoalList(GoalList $goalList): static
    {
        if (!$this->goalLists->contains($goalList)) {
            $this->goalLists->add($goalList);
            $goalList->setLanguage($this);
        }

        return $this;
    }

    public function removeGoalList(GoalList $goalList): static
    {
        if ($this->goalLists->removeElement($goalList)) {
            // set the owning side to null (unless already changed)
            if ($goalList->getLanguage() === $this) {
                $goalList->setLanguage(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
