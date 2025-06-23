<?php

namespace App\Controller;

use App\Entity\Archive;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ArchiveRepository;

final class ArchiveController extends AbstractController
{
    #[Route('/archive', name: 'app_archive')]
    public function index(ArchiveRepository $ArchiveRepository): Response
    {
        return $this->render('archive/index.html.twig', [
            'ArchiveInHomepage' => $ArchiveRepository->findByIsHomepage(true)
        ]);
    }

    #[Route('/archive/{id}', name: 'app_archive_show')]
public function show(Archive $archive): Response
{
    return $this->render('archive/show.html.twig', [
        'archive' => $archive,
    ]);
}

}
