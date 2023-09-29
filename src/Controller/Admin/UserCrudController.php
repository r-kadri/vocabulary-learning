<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    use Trait\ReadOnlyTrait;

    public static function getEntityFqcn(): string
    {
        return User::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('username'),
            EmailField::new('email'),
            AssociationField::new('wordLists')
                ->onlyOnIndex(),
            ArrayField::new('wordLists')
                ->onlyOnDetail(),
            AssociationField::new('goalLists')
                ->onlyOnIndex(),
            ArrayField::new('goalLists')
                ->onlyOnDetail(),
            ArrayField::new('roles'),
            CollectionField::new('languages')
        ];
    }
    
}
