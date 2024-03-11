<?php

namespace App\Form;

use App\Entity\Job;
use App\Entity\Video;
use App\Entity\VideoJobWorker;
use App\Entity\Worker;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoJobWorkerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('video', EntityType::class, [
                'class' => Video::class,
                'choice_label' => 'label',
            ])
            ->add('job', EntityType::class, [
                'class' => Job::class,
                'choice_label' => 'label',
            ])
            ->add('worker', EntityType::class, [
                'class' => Worker::class,
                'choice_label' => 'firstname',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VideoJobWorker::class,
        ]);
    }
}
