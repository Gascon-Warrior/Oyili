<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pictureFileName = null;

    #[ORM\Column]
    private ?bool $isPromoted = null;

    #[ORM\ManyToOne(inversedBy: 'pictures')]
    private ?client $client = null;

    #[ORM\ManyToOne(inversedBy: 'pictures')]
    private ?worker $worker = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPictureFileName(): ?string
    {
        return $this->pictureFileName;
    }

    public function setPictureFileName(string $pictureFileName): static
    {
        $this->pictureFileName = $pictureFileName;

        return $this;
    }

    public function isIsPromoted(): ?bool
    {
        return $this->isPromoted;
    }

    public function setIsPromoted(bool $isPromoted): static
    {
        $this->isPromoted = $isPromoted;

        return $this;
    }

    public function getClient(): ?client
    {
        return $this->client;
    }

    public function setClient(?client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getWorker(): ?worker
    {
        return $this->worker;
    }

    public function setWorker(?worker $worker): static
    {
        $this->worker = $worker;

        return $this;
    }
}
