<?php

namespace App\Service;

use App\Entity\Language;
use App\Entity\User;
use App\Repository\LanguageRepository;
use Doctrine\ORM\EntityManagerInterface;

final class LanguageService
{
    public function __construct(
        private LanguageRepository $languageRepository,
        private EntityManagerInterface $entityManager
    ) {}

    public function getLanguages(): array {
        return $this->languageRepository->findAll();
    }

    public function addLanguageToUser(Language $language, User $user): void {
        $user->addLanguage($language);
        $language->addUser($user);

        $this->entityManager->persist($user);
        $this->entityManager->persist($language);
        $this->entityManager->flush();
    }

    public function removeLanguageFromUser(Language $language, User $user): void {
        $language->removeUser($user);
        $this->entityManager->persist($language);
        $this->entityManager->flush();
    }
}