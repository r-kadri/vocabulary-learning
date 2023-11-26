<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: WordList::class)]
    private Collection $wordLists;

    #[ORM\ManyToMany(targetEntity: Language::class, inversedBy: 'users')]
    #[ORM\OrderBy(['name' => 'ASC'])]
    private Collection $languages;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: GoalList::class)]
    private Collection $goalLists;

    public function __construct()
    {
        $this->wordLists = new ArrayCollection();
        $this->languages = new ArrayCollection();
        $this->goalLists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

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
            $wordList->setUser($this);
        }

        return $this;
    }

    public function removeWordList(WordList $wordList): static
    {
        if ($this->wordLists->removeElement($wordList)) {
            // set the owning side to null (unless already changed)
            if ($wordList->getUser() === $this) {
                $wordList->setUser(null);
            }
        }

        return $this;
    }

    /**
     * Get all languages the user is learning
     * 
     * @return Collection<int, Language>
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    public function addLanguage(Language $language): static
    {
        if (!$this->languages->contains($language)) {
            $this->languages->add($language);
        }

        return $this;
    }

    public function removeLanguage(Language $language): static
    {
        $this->languages->removeElement($language);

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
            $goalList->setUser($this);
        }

        return $this;
    }

    public function removeGoalList(GoalList $goalList): static
    {
        if ($this->goalLists->removeElement($goalList)) {
            // set the owning side to null (unless already changed)
            if ($goalList->getUser() === $this) {
                $goalList->setUser(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getUsername();
    }
}
