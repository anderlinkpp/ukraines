<?php

namespace App\Controller;

use App\Form\EvenementFilterType;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/evenement', name: 'evenements_')]
class EvenementController extends AbstractController
{
    #[Route('/', name: 'liste')]
    public function index(Request $request, EvenementRepository $repo): Response
    {
        $form = $this->createForm(EvenementFilterType::class);
        $form->handleRequest($request);

        $motCle = $form->getData()['motCle'] ?? null;

        $evenements = $repo->findByKeyword($motCle);

        return $this->render('evenement/index.html.twig', [
            'form' => $form->createView(),
            'evenements' => $evenements,
        ]);
    }

    #[Route('/event/{slug}', name: 'detail')]
    public function show(string $slug, EvenementRepository $repo): Response
    {
        $evenements = $repo->findOneBy(['slug' => $slug]);

        if (!$evenements) {
            return $this->redirectToRoute('evenements_liste');
        }

        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenements,
        ]);
    }
}
