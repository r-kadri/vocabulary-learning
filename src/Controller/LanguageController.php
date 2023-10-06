<?php

namespace App\Controller;

use App\Repository\LanguageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/languages')]
final class LanguageController extends AbstractController
{
    #[Route('/', name: 'language_index')]
    public function index(LanguageRepository $languageRepository): Response
    {
        $languages = $languageRepository->findAll();
        return $this->render('language/index.html.twig', [
            'languages' => $languages
        ]);
    }
}
