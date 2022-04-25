<?php

namespace App\Repository;

use App\Entity\BienSearcher;
use App\Entity\Rent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rent|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rent|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rent[]    findAll()
 * @method Rent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rent::class);
    }

    // /**
    //  * @return Rent[] Returns an array of Rent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rent
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findAllRentedBiens(BienSearcher $search)
    {
        // query qui retourne tous les biens dont la date de fin est inférieure à la date du jour
        $query = $this->createQueryBuilder('r')
            ->where('r.dateEnd <= :date')
            ->setParameter('date', new \DateTime())
            ->getQuery();

        return $query->getResult();
    }

    public function findBiensByVille(BienSearcher $search)
    {
        // query qui retourne tous les biens selon la ville choisie
        $query = $this->createQueryBuilder('r')
            ->where('r.ville = :ville')
            ->setParameter('ville', $search->getVille())
            ->getQuery();

        return $query->getResult();
    }
}
