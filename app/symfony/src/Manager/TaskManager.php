<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class TaskManager
{
    private EntityRepository $taskRepository;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->taskRepository = $this->em->getRepository(Task::class);
    }

    public function Tasks(): array
    {
        return $this->taskRepository->findAll();
    }

    public function closeTask(Task $task): void
    {
        $task = $this->taskRepository->findOneById($task);

        if ($task) {
            $task->setState(true);
            $this->saveTask($task);
        }
    }

    public function saveTask(Task $task): void
    {
        $this->em->persist($task);
        $this->em->flush();
    }
}