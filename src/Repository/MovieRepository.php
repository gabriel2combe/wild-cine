<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


/**
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    /**
     * @return Movie[] Returns an array of Movie objects
     */
    public function findSomeTodayRelease($count): array //Returns '$count' random movies released today
    {
        return $this->createQueryBuilder('m')
            ->addSelect('RAND() as HIDDEN rand')
            ->addOrderBy('rand')
            ->where('m.release_date = CURRENT_DATE()')
            ->setMaxResults($count)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Movie[]
     */
    public function findByNextRelease(): array //Returns the next 9 release of movies
    {
        $max_result = 9;
        
        return $this->createQueryBuilder('m') // "m" is an alias for Movie table
            ->where('m.release_date > CURRENT_TIMESTAMP()')
            ->orderBy('m.release_date', 'ASC')
            ->setMaxResults($max_result)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Movie[] Returns an array of Movie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Movie
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
