<?php

namespace App\Controller\Admin;

use App\Entity\Glasses;
use App\Controller\Admin\GlassesCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GlassesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Glasses::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setPageTitle('index', 'Liste des %entity_label_plural%')
        ->setEntityLabelInSingular('Lunettes')
        ->setEntityLabelInPlural('Lunettes');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('Lunettes')->setIcon('fa fa-glasses'),
            IdField::new('id')->hideOnIndex(),
            TextField::new('name', 'Modèle'),
            TextField::new('brand', 'Marque'),
            TextField::new('color', 'Couleur'),
            TextField::new('shape', 'Forme'),
            IntegerField::new('size', 'Taille'),
            IntegerField::new('price', 'Prix'),
        ];
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
