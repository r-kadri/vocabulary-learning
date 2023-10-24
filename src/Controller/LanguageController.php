<?php

namespace App\Controller;

use App\Entity\Language;
use App\Service\LanguageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/languages')]
final class LanguageController extends AbstractController
{
    public function __construct(
        private LanguageService $languageService
    ) {}

    #[Route('/', name: 'language_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('language/index.html.twig', [
            'languages' => $this->languageService->getLanguages()
        ]);
    }

    #[Route('/{id}/add', name: 'user_add_language', methods: ['POST'])]
    public function userAddLanguage(Language $language): Response
    {
        $this->languageService->addLanguageToUser($language, $this->getUser());
        return $this->redirectToRoute('language_index');
    }

    #[Route('/{id}/remove', name: 'user_remove_language', methods: ['POST'])]
    public function userRemoveLanguage(Language $language): Response {
        $this->languageService->removeLanguageFromUser($language, $this->getUser());
        return $this->redirectToRoute('language_index');
    }
}
