<?php

namespace App\Repository;

use App\Entity\Task;
use App\Entity\ListEntity;
use App\Entity\TaskStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Task>
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    /**
     * @return Task[]
     */
    public function findByList(ListEntity $list): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.list = :list')
            ->setParameter('list', $list)
            ->orderBy('t.createdAt', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Task[]
     */
    public function findByStatus(TaskStatus $status): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.status = :status')
            ->setParameter('status', $status)
            ->orderBy('t.dueAt', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function save(Task $task, bool $flush = true): void
    {
        $this->_em->persist($task);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function remove(Task $task, bool $flush = true): void
    {
        $this->_em->remove($task);
        if ($flush) {
            $this->_em->flush();
        }
    }
}
