<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateursRepository;

class ValidationController extends AbstractController
{
    private $entityManager;
    private $utilisateursRepository;

    public function __construct(EntityManagerInterface $entityManager, UtilisateursRepository $utilisateursRepository)
    {
        $this->entityManager = $entityManager;
        $this->utilisateursRepository = $utilisateursRepository;
    }

    #[Route('/validation/{email}/{token}', name: 'app_validation')]
    public function validateAccount(string $email, string $token): Response
    {
        $utilisateur = $this->utilisateursRepository->findOneBy(['email' => $email, 'token' => $token]);

        if ($utilisateur) {
            $utilisateur->setIsVerified(true);
            $utilisateur->setToken(null);
            $this->entityManager->flush();

            

            // Redirection vers une page de confirmation
            return $this->redirectToRoute('app_login');
        }

        // Gérer l'erreur si l'utilisateur n'est pas trouvé
        $this->addFlash('danger', 'Le lien de validation est invalide.');

        return $this->redirectToRoute('app_home');
    }
}
