<?php

namespace App\Controller\Admin;

use App\Entity\WordLevel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class WordLevelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WordLevel::class;
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
