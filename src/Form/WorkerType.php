<?php

namespace App\Form;

use App\Entity\Worker;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('position', TextType::class, [
                'label' => 'Poste', 
                'required' => true 
            ])                
            ->add('presentation', TextareaType::class, [
                'label' => 'Présentation'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('lastname',  TextType::class, [
                'label' => 'Nom de famille'
            ])
            ->add('picture', FileType::class, [
                'label' => 'Photo',
                'multiple' => true,
                'mapped' => false
            ])
            ->add('alt', TextType::class, [
                'label' => 'Texte alternatif',
                'mapped' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Worker::class,
        ]);
    }
}
