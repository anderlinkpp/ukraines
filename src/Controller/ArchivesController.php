<?php

namespace App\Controller;

use App\Entity\Archives;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ArchivesRepository;

final class ArchivesController extends AbstractController
{
    #[Route('/archives', name: 'app_archives')]
    public function index(ArchivesRepository $ArchivesRepository): Response
    {
        return $this->render('archives/index.html.twig', [
            'ArchivesInHomepage' => $ArchivesRepository->findByIsHomepage(true)
        ]);
    }

    #[Route('/archives/{id}', name: 'app_archives_show')]
public function show(Archives $archives): Response
{
    return $this->render('archives/show.html.twig', [
        'archives' => $archives,
    ]);
}

}
