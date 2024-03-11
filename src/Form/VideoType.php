<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Tag;
use App\Entity\Video;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('videoFileName')
            ->add('label')
            ->add('vimeoId')
            ->add('caption')
            ->add('isPromoted')
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'company',
            ])
            ->add('tag', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'label',
                'multiple' => true,
            ]);
            //TODO: Securisation des formulaires et entité
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
