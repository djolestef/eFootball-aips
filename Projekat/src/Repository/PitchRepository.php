<?php

namespace App\Repository;

use App\Entity\Pitch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pitch|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pitch|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pitch[]    findAll()
 * @method Pitch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PitchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pitch::class);
    }

    /**
     * @param Pitch $pitch
     * @throws \Doctrine\ORM\ORMException
     */
    public function persist(Pitch $pitch): void
    {
        $this->_em->persist($pitch);
    }

    /**
     * @param Pitch $pitch
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Pitch $pitch): ?int
    {
        $this->persist($pitch);
        $this->_em->flush();
        return $pitch->getId();
    }

    // /**
    //  * @return Pitch[] Returns an array of Pitch objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pitch
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
