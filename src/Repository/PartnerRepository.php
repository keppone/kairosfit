<?php

namespace App\Repository;

use App\Entity\Partner;
use Doctrine\ORM\Query;
use App\Entity\PartnerSearchData;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Partner>
 *
 * @method Partner|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partner|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partner[]    findAll()
 * @method Partner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Partner::class);
    }


    /**
     * @return Query 
     */
    public function findAllVisibleQuery(PartnerSearchData $search): Query
    {
        $query= $this->findVisibleQuery();

        if (!empty($search->getSearchWord())){
            $query = $query
                ->andWhere('p.name LIKE :searchWord')
                ->setParameter('searchWord', "%{$search->getSearchWord()}%");
        }

        if (!empty($search->getPartnerActive())){
            $query = $query
                ->andWhere('p.activate = 1');
        }

        if (!empty($search->getPartnerInactive())){
            $query = $query
                ->andWhere('p.activate = 0');
        }
        return $query->getQuery();
    }


    /**
     * @return Partner[] Returns an array of Partner objects
     */
     public function findLatest(): array
    {
        return $this->findVisibleQuery()
            ->setMaxResults('4')
            ->getQuery()
            ->getResult();
    }

    private function findVisibleQuery()
    {
        return $this->createQueryBuilder('p')
            ->where('p.id != 0');
    }

    //    /**
    //     * @return Partner[] Returns an array of Partner objects
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

    //    public function findOneBySomeField($value): ?Partner
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
