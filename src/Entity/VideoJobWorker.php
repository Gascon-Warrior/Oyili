<?php

namespace App\Entity;

use App\Repository\VideoJobWorkerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VideoJobWorkerRepository::class)]
class VideoJobWorker
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'videoJobWorkers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?video $video = null;

    #[ORM\ManyToOne]
    private ?job $job = null;

    #[ORM\ManyToOne]
    private ?worker $worker = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVideo(): ?video
    {
        return $this->video;
    }

    public function setVideo(?video $video): static
    {
        $this->video = $video;

        return $this;
    }

    public function getJob(): ?job
    {
        return $this->job;
    }

    public function setJob(?job $job): static
    {
        $this->job = $job;

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
