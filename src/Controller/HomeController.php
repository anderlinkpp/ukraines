<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Evenements;
use App\Entity\Images;
use App\Service\ArticleService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
//use App\Repository\HeaderRepository;
use App\Repository\EvenementsRepository; 

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index( EvenementsRepository $evenementsRepository): Response
    {
        return $this->render('pages/accueil/index.html.twig', [
               // 'headers' => $headerRepository->findAll(),
           'EvenementsInHomepage' => $evenementsRepository->findByIsHomepage(true)
        ]);
    }
   
    #[Route('/articles', name: 'app_articles')]
    public function indexArticles(EntityManagerInterface $entityManagerInterface, ArticleService $articleService): Response
    {
        $articles = $articleService->getPaginatedArticles();
        $categories = $entityManagerInterface->getRepository(Categories::class)->findAll();
        $images = $entityManagerInterface->getRepository(Images::class)->findAll();

        return $this->render('pages/actualites/articles/articles.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
            'images' => $images,
        ]);
    }

    #[Route('/calendrier', name: 'app_calendar')]
    public function showCalendar(EntityManagerInterface $entityManagerInterface): Response
    {
        $events = $entityManagerInterface->getRepository(Evenements::class)->findAll();

        $events_JSON_format = [];
        foreach ($events as $event) {
            if ($event->isActivation() == 1) {
                // Set permalien et description à null si pas d'article associé
                $description = false;
                $permalien = false;

                if ($event->getArticle()) {
                    $firstArticle = $event->getArticle()->first();
                    if ($firstArticle) {
                        $description = $firstArticle->getCourteDescription();
                        $permalien = $firstArticle->getPermalien();
                    }
                }
            
                $events_JSON_format[] = [
                    'title' => $event->getNom(),
                    'start' => $event->getDateDebut()->format('Y-m-d H:i:s'),
                    'end' => $event->getDateFin()->format('Y-m-d H:i:s'),
                    'description' => $description,
                    'permalien' => $permalien,
                ];
            }
        }

        $events_JSON_format = json_encode($events_JSON_format);

        return $this->render('pages/actualites/calendrier/calendrier.html.twig', [
            'events' => $events_JSON_format,
        ]);
    }

    // PAGES EN APPRENDRE PLUS
    #[Route('/histoire-de-l-ukraine', name: 'app_history')]
    public function showHistory(): Response
    {
        return $this->render('pages/en_apprendre_plus/histoire.html.twig', [
            'controller_name' => 'Histoire de l\'Ukraine',
        ]);
    }

    #[Route('/faq', name: 'app_faq')]
    public function showFAQ(): Response
    {
        return $this->render('pages/en_apprendre_plus/faq.html.twig', [
            'controller_name' => 'FAQ',
        ]);
    }

    #[Route('/galerie', name: 'app_gallery')]
    public function showGallery(EntityManagerInterface $entityManagerInterface): Response
    {
        $images = $entityManagerInterface->getRepository(Images::class)->findAll();

        return $this->render('pages/en_apprendre_plus/galerie.html.twig', [
            'images' => $images,
        ]);
    }
    // PAGES EN APPRENDRE PLUS

    // PAGES A-PROPOS
    #[Route('/a-propos/membres', name: 'app_members')]
    public function showMembers(): Response
    {
        return $this->render('pages/a_propos/membres.html.twig', [
            'controller_name' => 'Nos membres',
        ]);
    }

    #[Route('/a-propos/association', name: 'app_organization')]
    public function showOrganization(): Response
    {
        return $this->render('pages/a_propos/association.html.twig', [
            'controller_name' => 'Notre association',
        ]);
    }

    #[Route('/a-propos/partenaires', name: 'app_partners')]
    public function showPartners(): Response
    {
        return $this->render('pages/a_propos/partenaires.html.twig', [
            'controller_name' => 'Nos partenaires',
        ]);
    }
    
    #[Route('/a-propos/contactez-nous', name: 'app_contact_us')]
    public function showContact(): Response
    {
        return $this->render('pages/a_propos/contact.html.twig', [
            'controller_name' => 'Nous contacter',
        ]);
    }
    // PAGES A-PROPOS

    // PAGE ADHESION
    #[Route('/devenir-adherent', name: 'app_membership')]
    public function showMembership(): Response
    {
        return $this->render('pages/adhesion/adhesion.html.twig', [
            'controller_name' => 'Devenir adhérant',
        ]);
    }
    // PAGE ADHESION

    // PAGE SITE EN CONSTRUCTION
    #[Route('/WIP', name: 'app_WIP')]
    public function showWIP(): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('app_home');
        // } else {
        //     return $this->render('pages/accueil/site_en_construction.html.twig');
        // }
        return $this->render('pages/accueil/site_en_construction.html.twig');
    }
    // PAGE SITE EN CONSTRUCTION
    #[Route('/evenement/{slug}', name: 'evenement_show')]
    public function show(string $slug, EvenementsRepository $repo): Response
    {
        $evenements = $repo->findOneBy(['slug' => $slug]);

        if (!$evenements) {
            throw $this->createNotFoundException('Événement non trouvé');
        }

        return $this->render('pages/evenement/show.html.twig', [
            'evenement' => $evenements,
        ]);
    }
}