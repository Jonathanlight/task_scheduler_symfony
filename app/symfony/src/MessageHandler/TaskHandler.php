<?php

namespace App\MessageHandler;

use App\Manager\TaskManager;
use App\Message\TaskMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class TaskHandler
{
    public function __construct(protected TaskManager $taskManager)
    {
    }

    public function __invoke(TaskMessage $message): void
    {
        $task = $message->getTask();

        if ($task->isState() !== true) {
            sleep(10);
            $this->taskManager->closeTask($task);
        }
    }
}
