<?php

namespace App\Repository;

use App\Entity\ListEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ListEntity>
 */
class ListEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListEntity::class);
    }

    /**
     * @return ListEntity[]
     */
    public function findByUserId(string $userId): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.userId = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('l.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function save(ListEntity $list, bool $flush = true): void
    {
        $this->_em->persist($list);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function remove(ListEntity $list, bool $flush = true): void
    {
        $this->_em->remove($list);
        if ($flush) {
            $this->_em->flush();
        }
    }
}
