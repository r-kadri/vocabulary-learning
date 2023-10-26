<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\LanguageRepository;
use App\Service\WordListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lists')]
class WordListController extends AbstractController
{
    public function __construct(
        private WordListService $wordListService,
        private LanguageRepository $languageRepository
    ) {}

    #[Route('/', name: 'word_list_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        /**
         * @var User $user
         */
        $user = $this->getUser();
        $languageIso = $request->get('language');
        if($languageIso === 'all') {
            $wordLists = $this->wordListService->getAllLists($user);
            $language = 'all';
        } else {
            $language = $this->languageRepository->findOneBy(['iso639' => $languageIso]);
            $wordLists = $this->wordListService->getListsForLanguage($user, $language);
        }

        $language ?: $language = $this->wordListService->getUserFirstLanguage($user);

        return $this->render('word_list/index.html.twig', [
            'wordLists' => $wordLists,
            'selectedLanguage' => $language
        ]);
    }
}
