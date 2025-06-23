<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Categories;
use App\Entity\Images;
use App\Service\ArticleService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
    #[Route('/article/{permalien}', name: 'app_article')]
    public function showArticle(?Articles $article): Response
    {
        if (!$article) {
            return $this->redirectToRoute('app_articles');
        }

        return $this->render('pages/actualites/article/article.html.twig', [
            'article' => $article,
        ]);
    }

    public function searchArticlesBySearchBar(Request $request, EntityManagerInterface $entityManagerInterface, ArticleService $articleService): Response
    {
        $categories = $this->getCategories($entityManagerInterface);
        $images = $this->getImages($entityManagerInterface);

        $searchTerm = $request->query->get('search');

        $articles = $articleService->getPaginatedArticles(null, null, null, $searchTerm);

        return $this->render('pages/actualites/articles/articles.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
            'images' => $images,
        ]);
    }

    public function searchArticlesByCategory(?Categories $category, EntityManagerInterface $entityManagerInterface, ArticleService $articleService): Response
    {
        $categories = $this->getCategories($entityManagerInterface);
        $images = $this->getImages($entityManagerInterface);

        if (!$category) {
            return $this->redirectToRoute('app_articles');
        }
        
        $articles = $articleService->getPaginatedArticles($category, null, null, null);

        return $this->render('pages/actualites/articles/articles.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
            'images' => $images,
        ]);
    }
    
    public function searchArticlesByDate(Request $request, EntityManagerInterface $entityManagerInterface, ArticleService $articleService)
    {
        $categories = $this->getCategories($entityManagerInterface);
        $images = $this->getImages($entityManagerInterface);

        $year = $request->query->get('year');
        $month = $request->query->get('month');

        $articles = $articleService->getPaginatedArticles(null, $year, $month, null);

        return $this->render('pages/actualites/articles/articles.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
            'images' => $images,
        ]);
    }

    public function getCategories(EntityManagerInterface $entityManagerInterface){
        $categories = $entityManagerInterface->getRepository(Categories::class)->findAll();
        return $categories;
    }

    public function getImages(EntityManagerInterface $entityManagerInterface){
        $images = $entityManagerInterface->getRepository(Images::class)->findAll();
        return $images;
    }
}
