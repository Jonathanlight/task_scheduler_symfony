<?php

namespace App\Message;

use App\Entity\Task;

final class TaskMessage
{
    /**
     * @var \App\Entity\Task
     */
    private Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function getTask(): Task
    {
        return $this->task;
    }
}
