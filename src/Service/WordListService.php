<?php

namespace App\Service;

use App\Entity\Language;
use App\Entity\User;
use App\Repository\WordListRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

class WordListService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private WordListRepository $wordListRepository
    ) {}

     /**
     * Returns all word lists for a given user
     *
     * @param User $user
     * 
     * @return Collection
     */
    public function getAllLists(User $user): Collection
    {
        return $user->getWordLists();
    }

    /**
     * Returns all word lists for a given language or the first if language is null
     *
     * @param User $user
     * @param Language|null $language
     * 
     * @return array<int, WordList>
     */
    public function getListsForLanguage(User $user, Language $language = null): array
    { 
        return $this->wordListRepository->findBy(['user' => $user, 'language' => $language]);
    }
}
