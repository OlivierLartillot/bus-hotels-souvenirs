<?php

namespace App\Repository;

use App\Entity\InfosClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @extends ServiceEntityRepository<InfosClient>
 *
 * @method InfosClient|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfosClient|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfosClient[]    findAll()
 * @method InfosClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfosClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfosClient::class);
    }

    public function save(InfosClient $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(InfosClient $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return InfosClient[] Returns an array of InfosClient objects
     */
    public function findByDateMore(): array
    {
        $today = date("y-m-d");    
        return $this->createQueryBuilder('i')
            ->andWhere('i.day >= :today')
            ->setParameter('today', $today)
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?InfosClient
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
