<?php

namespace App\Repository;

use App\Entity\Articles;
use App\Entity\Categories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Articles>
 *
 * @method Articles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articles[]    findAll()
 * @method Articles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articles::class);
    }

    public function findForPagination(?Categories $category = null, ?string $year = null, ?string $month = null, ?string $searchTerm = null): Query
    {
        $queryBuilder = $this->createQueryBuilder('a')
            ->orderBy('a.dateCreation', 'DESC')
            ->andWhere('a.activation = :activation')
            ->setParameter('activation', 1);

        if ($category) {
            $queryBuilder->leftJoin('a.categorie', 'c')
                ->andWhere('c.id = :categoryId')
                ->setParameter('categoryId', $category->getId());
        }

        if ($year) {
            $queryBuilder->andWhere('YEAR(a.dateCreation) = :year')
                ->setParameter('year', $year);
        }

        if ($year && $month) {
            $queryBuilder->andWhere('YEAR(a.dateCreation) = :year')
                ->andWhere('MONTH(a.dateCreation) = :month')
                ->setParameter('year', $year)
                ->setParameter('month', $month);
        }

        if ($searchTerm) {
            $queryBuilder->andWhere($queryBuilder->expr()->like('a.titre', ':searchTerm'))
                ->orWhere($queryBuilder->expr()->like('a.description', ':searchTerm'))
                ->orWhere($queryBuilder->expr()->like('a.courteDescription', ':searchTerm'))
                ->setParameter('searchTerm', '%' . $searchTerm . '%');
        }

        return $queryBuilder->getQuery();
    }
}
