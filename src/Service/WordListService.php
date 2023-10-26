<?php

namespace App\Service;

use App\Entity\Language;
use App\Entity\User;
use App\Repository\WordListRepository;
use Doctrine\ORM\EntityManagerInterface;

class WordListService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private WordListRepository $wordListRepository
    ) {}

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
        $language ?: $language = $this->getUserFirstLanguage($user);
        return $this->wordListRepository->findBy(['user' => $user, 'language' => $language]);
    }

    /**
     * Returns all word lists for a given user
     *
     * @param User $user
     * 
     * @return array<int, WordList>
     */
    public function getAllLists(User $user): array
    {
        $lists = [];
        $userLanguages = $user->getLanguages();
        foreach($user->getWordLists() as $list) {
            if($userLanguages->contains($list->getLanguage())) {
                $lists[] = $list;
            }
        }

        // DOES NOT WORK YET ?
        usort($lists, function ($a, $b) {
            $languageComparison = strcmp($a->getLanguage(), $b->getLanguage());
            if ($languageComparison !== 0) {
                return $languageComparison;
            }
            return strcmp($a->getName(), $b->getName());
        });
        // DOES NOT WORK YET ?

        return $lists;
    }

    /**
     * Returns the first language for a given user
     *
     * @param User $user
     * 
     * @return Language|null
     */
    public function getUserFirstLanguage(User $user): Language | null
    {
        $userLanguages = $user->getLanguages();
        foreach($user->getWordLists() as $list) {
            if($userLanguages->contains($list->getLanguage())) {
                return $list->getLanguage();
            }
        }
        return null;
    }
}