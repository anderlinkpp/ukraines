<?php

namespace App\Controller\Admin;

use App\Entity\Archive;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;


class ArchiveCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Archive::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $required = true;

        if ($pageName == 'edit') {
            $required = false;
        }

        return [
            TextField::new('nom'),
            DateTimeField::new('dateDebut'),
            DateTimeField::new('dateFin'),
            TextField::new('lieu'),
            TextField::new('adresse'),
            TextField::new('ville'),
            TextField::new('codePostal'),
            BooleanField::new('activation'),
            #SlugField::new('slug')->setTargetFieldName('name')->setLabel('URL')->setHelp('URL de votre catégorie générée automatiquement'),
            BooleanField::new('isHomepage')->setLabel('Produit à la une ?')->setHelp("Vous permet d'afficher un produit sur la homepage"),
            DateTimeField::new('dateCreation'),
            DateTimeField::new('dateModification'),
            TextField::new('creationPar'),
            TextField::new('modificationPar'),
            TextEditorField::new('description')->setLabel('Description')->setHelp('Description de votre evenement'),
            ImageField::new('illustration')
            ->setLabel('Image')
            ->setHelp('Image du produit en 600x600px')
            ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')
            ->setBasePath('/uploads')
            ->setUploadDir('/public/uploads')
            ->setRequired($required)
        ,
        ];
    }
}
