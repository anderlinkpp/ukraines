<?php

namespace App\Service;

use App\Entity\Categories;
use App\Repository\ArticlesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class ArticleService
{
    public function __construct(
        private RequestStack $requestStack,
        private ArticlesRepository $articleRepository,
        private PaginatorInterface $paginator
    ) {

    }

    public function getPaginatedArticles(?Categories $category = null, ?string $year = null, ?string $month = null, ?string $searchTerm = null)
    {
        $request = $this->requestStack->getMainRequest();
        $page = $request->query->getInt('page', 1);
        $limit = 5;
        $articlesQuery = $this->articleRepository->findForPagination($category, $year, $month, $searchTerm);

        return $this->paginator->paginate($articlesQuery, $page, $limit);
    }
}