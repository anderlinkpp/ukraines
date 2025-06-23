<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;
use App\Repository\UtilisateursRepository;
use App\Mailer\ValidationMailer;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, UtilisateursRepository $utilisateursRepository, ValidationMailer $mailer): Response
    {
        $utilisateur = new Utilisateurs();
        // Ajout des valeurs par défaut
        $utilisateur->setAdhesion(false); // Met l'adhésion à 0

        $form = $this->createForm(InscriptionType::class, $utilisateur);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifier si le pseudo est déjà utilisé
            $existingUser = $utilisateursRepository->findOneBy([
                'username' => $utilisateur->getUsername(),
            ]);
        
            if ($existingUser) {
                // Ajouter un message d'erreur au formulaire
                $form->get('username')->addError(new FormError('Veuillez entrer un autre pseudo.'));
            } else {
                // Hashage du mot de passe
                $hashedPassword = $passwordHasher->hashPassword($utilisateur, $utilisateur->getPassword());
                $utilisateur->setPassword($hashedPassword);
        
                // Définition de la date d'inscription
                $utilisateur->setDateInscription(new \DateTime());

                // Générer un token unique
                $token = md5(uniqid('', true));
                $utilisateur->setToken($token);
        
                // Persistence de l'utilisateur
                $entityManager->persist($utilisateur);
                $entityManager->flush();

                // Envoi de l'e-mail de validation
                $mailer->sendValidationEmail($utilisateur);
        
                // Redirection vers une page de succès ou autre
                return $this->redirectToRoute('app_home');
            }
        }

        return $this->render('security/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
