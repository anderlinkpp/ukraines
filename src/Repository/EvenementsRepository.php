<?php

namespace App\Repository;

use App\Entity\Evenements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenements::class);
    }
    public function findByHomepage(): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.isHomepage = :val')
            ->setParameter('val', true)
            ->getQuery()
            ->getResult();
    }
    // src/Repository/EvenementRepository.php
public function findByKeyword(?string $motCle): array
{
    $qb = $this->createQueryBuilder('e');

    if ($motCle) {
        $qb->andWhere('e.titre LIKE :motCle OR e.description LIKE :motCle')
           ->setParameter('motCle', '%' . $motCle . '%');
    }

    return $qb->getQuery()->getResult();
}

public function filtrer(?string $type, ?string $lieu, ?string $date): array
{
    $qb = $this->createQueryBuilder('e');

    if ($type) {
        $qb->andWhere('e.type = :type')->setParameter('type', $type);
    }

    if ($lieu) {
        $qb->andWhere('e.lieu LIKE :lieu')->setParameter('lieu', '%' . $lieu . '%');
    }

    if ($date) {
        $qb->andWhere('DATE(e.date) = :date')->setParameter('date', new \DateTime($date));
    }

    return $qb->getQuery()->getResult();
}

//    /**
//     * @return Product[] Returns an array of Product objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
