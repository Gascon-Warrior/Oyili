<?php

namespace App\Form;

use App\Entity\Worker;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;

class WorkerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('position', TextType::class, [
                'label' => 'Poste', 
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le poste ne peut pas être vide.',
                    ])
                ]
            ])                
            ->add('presentation', TextareaType::class, [
                'label' => 'Présentation',
                'constraints' => [
                    new NotBlank([
                        'message' => 'La présentation ne peut pas être vide.',
                    ])
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom', 
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le prénom ne peut pas être vide.',
                    ])
                ]
            ])
            ->add('lastname',  TextType::class, [
                'label' => 'Nom de famille',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le nom de famille ne peut pas être vide.',
                    ])
                ]
            ])
            ->add('picture', FileType::class, [
                'label' => 'Photo',
                'multiple' => true,
                'mapped' => false,
                'constraints' => [
                    new All(
                        new Image([
                            'maxSize' => '400k',
                            'maxSizeMessage' => 'La taille maximale de l\'image doit être de 400ko.',
                        ])
                    )                    
                ]
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
