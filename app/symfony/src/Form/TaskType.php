<?php

namespace App\Form;

use App\Entity\Task;
use App\Enum\TaskPriorityEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $priorities =  array_flip(TaskPriorityEnum::getTypesLabels());

        $builder
            ->add('name')
            ->add('description', TextareaType::class, [
                'required' => false,
            ])
            ->add('priority', ChoiceType::class, [
                'choices' => $priorities,
                'expanded' => false,
                'multiple' => false,
                'label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
