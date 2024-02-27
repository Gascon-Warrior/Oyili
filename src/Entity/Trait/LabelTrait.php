<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait LabelTrait
{

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 3,
        max: 50, 
        minMessage: 'Le label doit comporter au moins  {{ limit }} caractères.', 
        maxMessage: 'Le label doit comporter {{ limit }} caractères maximum.',
    )]
    private ?string $label = null;

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }
}
