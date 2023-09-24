<?php

namespace App\Entity;

use App\Repository\WordListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WordListRepository::class)]
class WordList
{
    use Trait\IdNameTrait;

    #[ORM\OneToMany(mappedBy: 'list', targetEntity: Word::class)]
    private Collection $words;

    #[ORM\ManyToOne(inversedBy: 'wordLists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'wordLists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Language $language = null;

    public function __construct()
    {
        $this->words = new ArrayCollection();
    }

    /**
     * @return Collection<int, Word>
     */
    public function getWords(): Collection
    {
        return $this->words;
    }

    public function addWord(Word $word): static
    {
        if (!$this->words->contains($word)) {
            $this->words->add($word);
            $word->setList($this);
        }

        return $this;
    }

    public function removeWord(Word $word): static
    {
        if ($this->words->removeElement($word)) {
            // set the owning side to null (unless already changed)
            if ($word->getList() === $this) {
                $word->setList(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    public function setLanguage(?Language $language): static
    {
        $this->language = $language;

        return $this;
    }
}
