<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;

class ProfilController extends AbstractController
{
    
    #[Route('/profil', name: 'app_profile')]
     
    public function index(): Response
    {
        $utilisateur = $this->getUser(); // Obtient l'utilisateur actuellement connecté

        return $this->render('pages/profil/profil.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }
}