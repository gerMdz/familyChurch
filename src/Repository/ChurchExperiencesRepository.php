<?php

namespace App\Repository;

use App\Entity\ChurchExperiences;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ChurchExperiences>
 *
 * @method ChurchExperiences|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChurchExperiences|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChurchExperiences[]    findAll()
 * @method ChurchExperiences[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChurchExperiencesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChurchExperiences::class);
    }

    public function add(ChurchExperiences $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ChurchExperiences $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ChurchExperiences[] Returns an array of ChurchExperiences objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ChurchExperiences
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
