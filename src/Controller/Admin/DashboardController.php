<?php

namespace App\Controller\Admin;

use App\Entity\Goal;
use App\Entity\GoalList;
use App\Entity\Language;
use App\Entity\User;
use App\Entity\Word;
use App\Entity\WordLevel;
use App\Entity\WordList;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Vocabulary Learning');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Go back to the website', 'fas fa-home', 'app_index');
        yield MenuItem::linkToCrud('All goals', 'fas fa-thumb-tack', Goal::class);
        yield MenuItem::linkToCrud('User goal lists', 'fas fa-tasks', GoalList::class);
        yield MenuItem::linkToCrud('Languages', 'fas fa-language', Language::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('All words', 'fas fa-commenting', Word::class);
        yield MenuItem::linkToCrud('Word levels', 'fas fa-lightbulb', WordLevel::class);
        yield MenuItem::linkToCrud('User word lists', 'fas fa-list', WordList::class);
    }
}
