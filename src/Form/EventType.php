<?php

namespace App\Form;

use App\Entity\Animator;
use App\Entity\Category;
use App\Entity\Event;
use App\Entity\Room;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
                'label' => 'Titre'
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
                'label' => 'Description'
            ])
            ->add('start_time', DateTimeType::class, [
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
                'label' => 'Date de début'
            ])
            ->add('end_time', DateTimeType::class, [
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
                'label' => 'Date de fin'
            ])
            ->add('animator', EntityType::class, [
                'class' => Animator::class,
                'choice_label' => 'fullname',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
                'label' => 'Animateur'
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
                'label' => 'Catégorie'
            ])
            ->add('room', EntityType::class, [
                'class' => Room::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
                'label' => 'Salle'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
