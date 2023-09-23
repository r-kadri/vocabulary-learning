<?php

namespace App\Entity;

use App\Repository\WordRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WordRepository::class)]
class Word
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $original = null;

    #[ORM\Column(length: 255)]
    private ?string $enTranslation = null;

    #[ORM\ManyToOne(inversedBy: 'words')]
    #[ORM\JoinColumn(nullable: false)]
    private ?WordLevel $level = null;

    #[ORM\ManyToOne(inversedBy: 'words')]
    #[ORM\JoinColumn(nullable: false)]
    private ?WordList $list = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOriginal(): ?string
    {
        return $this->original;
    }

    public function setOriginal(string $original): static
    {
        $this->original = $original;

        return $this;
    }

    public function getEnTranslation(): ?string
    {
        return $this->enTranslation;
    }

    public function setEnTranslation(string $enTranslation): static
    {
        $this->enTranslation = $enTranslation;

        return $this;
    }

    public function getLevel(): ?WordLevel
    {
        return $this->level;
    }

    public function setLevel(?WordLevel $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getList(): ?WordList
    {
        return $this->list;
    }

    public function setList(?WordList $list): static
    {
        $this->list = $list;

        return $this;
    }
}
