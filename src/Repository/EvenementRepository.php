<?php

namespace App\Repository;

use App\Entity\Evenements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenements::class);
    }

    public function findByKeyword(?string $motCle): array
    {
        $qb = $this->createQueryBuilder('e');

        if ($motCle) {
            $qb->andWhere('e.titre LIKE :motCle OR e.description LIKE :motCle')
               ->setParameter('motCle', '%' . $motCle . '%');
        }

        return $qb->getQuery()->getResult();
    }
}
