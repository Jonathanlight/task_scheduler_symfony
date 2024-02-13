<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Manager\TaskManager;
use App\Message\TaskMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

class TaskController extends AbstractController
{
    #[Route('/', name: 'app_task')]
    public function index(Request $request, TaskManager $taskManager): Response
    {
        $form = $this->createForm(TaskType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $taskManager->saveTask($task);

            return $this->redirectToRoute('app_task');
        }

        return $this->render('task/index.html.twig', [
            'tasks' => $taskManager->Tasks(),
            'form' => $form->createView(),
        ]);
    }

    #[Route('/task-run/{{id}}', name: 'run_task')]
    public function run_task(Task $task, MessageBusInterface $bus): Response
    {
        $bus->dispatch(new TaskMessage($task));

        return $this->redirectToRoute('app_task');
    }
}
