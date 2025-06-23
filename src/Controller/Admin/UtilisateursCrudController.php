<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateurs;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UtilisateursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Utilisateurs::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('nom')->setLabel('Prénom'),
            TextField::new('prenom')->setLabel('Nom'),
            TextField::new('username')->setLabel('pseudo'),
            TextField::new('password')->setLabel('Mot de passe'),
            #DateField::new('lastLoginAt')->setLabel('Dernière connexion')->onlyOnIndex(),
            ChoiceField::new('roles')->setLabel('Permissions')->setHelp('Vous pouvez choisir le rôle de cet utilisateur.')->setChoices([
                'ROLE_USER' => 'ROLE_USER',
                'ROLE_ADMIN' => 'ROLE_ADMIN',
            ])->allowMultipleChoices(),
            TextField::new('email')->setLabel('Email'),
        ];
    }
    
}
