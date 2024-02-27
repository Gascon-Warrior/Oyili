<?php

namespace App\Form;

use App\Entity\Tag;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label', TypeTextType::class, [
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'max' => 120,
                        'minMessage' => 'La longueur minimale est de {{ limit }} caractères.',
                        'maxMessage' => 'La longueur maximale est de {{ limit }} caractères.',
                    ])
                ],
                'attr' => [
                    'required' => 'required',
                ]                
                ]);
           
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tag::class,
        ]);
    }
}
