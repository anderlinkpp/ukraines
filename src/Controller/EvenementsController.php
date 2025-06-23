<?php

namespace App\Controller;

use Symfony\Component\String\Slugger\SluggerInterface;
use App\Repository\EvenementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

 

class EvenementsController extends AbstractController
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    #[Route('/event/{slug}', name: 'app_event')]
    public function index($slug, EvenementsRepository $evenementsRepository): Response
    {
        $evenements = $evenementsRepository->findOneBySlug($slug);

        if (!$evenements) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('pages/evenement/show.html.twig', [
            'evenement' => $evenements,
        ]);
    }
}
