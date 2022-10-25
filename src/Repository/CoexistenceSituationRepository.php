<?php

namespace App\Repository;

use App\Entity\CoexistenceSituation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CoexistenceSituation>
 *
 * @method CoexistenceSituation|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoexistenceSituation|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoexistenceSituation[]    findAll()
 * @method CoexistenceSituation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoexistenceSituationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoexistenceSituation::class);
    }

    public function add(CoexistenceSituation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CoexistenceSituation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CoexistenceSituation[] Returns an array of CoexistenceSituation objects
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

//    public function findOneBySomeField($value): ?CoexistenceSituation
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
