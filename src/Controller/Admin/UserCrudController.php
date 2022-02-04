<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Controller\Admin\UserCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setPageTitle('index', 'Liste des %entity_label_plural%')
        ->setEntityLabelInSingular('utilisateur')
        ->setEntityLabelInPlural('utilisateurs');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('Utilisateur')->setIcon('fa fa-address-card-o'),
            IdField::new('id')->hideOnIndex(),
            TextField::new('firstname', 'Prénom'),
            TextField::new('lastname', 'Nom'),
            TextField::new('email', 'Email'),
            TextField::new('phonenumber', 'Téléphone'),
        ];
    }


}
