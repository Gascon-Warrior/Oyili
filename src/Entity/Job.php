<?php

namespace App\Entity;

use App\Entity\Trait\LabelTrait;
use App\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/*TODO: Valider les champs*/

#[ORM\Entity(repositoryClass: JobRepository::class)]
#[UniqueEntity(fields:['label'], message: 'Ce métier existe déjà!')]
class Job
{   
    use LabelTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
