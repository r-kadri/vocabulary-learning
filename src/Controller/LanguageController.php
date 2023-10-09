<?php

namespace App\Controller;

use App\Entity\Language;
use App\Entity\User;
use App\Repository\LanguageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/languages')]
final class LanguageController extends AbstractController
{
    #[Route('/', name: 'language_index', methods: ['GET'])]
    public function index(LanguageRepository $languageRepository): Response
    {
        $languages = $languageRepository->findAll();
        return $this->render('language/index.html.twig', [
            'languages' => $languages
        ]);
    }

    #[Route('/{id}', name: 'user_add_language', methods: ['POST'])]
    public function userAddLanguage(Language $language, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var User $user */
        $user = $this->getUser();
        $user->addLanguage($language);
        $language->addUser($user);

        $entityManager->persist($user);
        $entityManager->persist($language);
        $entityManager->flush();

        return $this->redirectToRoute('language_index');
    }

    #[Route('/{id}', name: 'user_remove_language', methods: ['POST'])]
    public function userRemoveLanguage(Language $language, EntityManagerInterface $entityManager) {
        dd('test');
        /** @var User $user */
        $user = $this->getUser();
        $language->removeUser($user);

        $entityManager->persist($language);
        $entityManager->flush();

        return $this->redirectToRoute('language_index');
    }
}
