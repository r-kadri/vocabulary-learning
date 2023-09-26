<?php

namespace App\Controller\Admin;

use App\Entity\GoalList;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GoalListCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GoalList::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
