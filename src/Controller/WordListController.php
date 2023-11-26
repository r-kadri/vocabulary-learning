<?php

namespace App\Controller;

use App\Entity\Language;
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
        $language = $this->languageRepository->findOneBy(['iso639' => $request->get('language')]);
        $language === null
            ? $wordLists = $this->wordListService->getAllLists($user)
            : $wordLists = $this->wordListService->getListsForLanguage($user, $language);

        return $this->render('word_list/index.html.twig', [
            'wordLists' => $wordLists,
            'currentLanguage' => $language,
        ]);
    }
}
