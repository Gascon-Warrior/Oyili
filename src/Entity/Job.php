<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobRepository::class)]
class Job
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\ManyToMany(targetEntity: Worker::class, mappedBy: 'job')]
    private Collection $workers;

    public function __construct()
    {
        $this->workers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Worker>
     */
    public function getWorkers(): Collection
    {
        return $this->workers;
    }

    public function addWorker(Worker $worker): static
    {
        if (!$this->workers->contains($worker)) {
            $this->workers->add($worker);
            $worker->addJob($this);
        }

        return $this;
    }

    public function removeWorker(Worker $worker): static
    {
        if ($this->workers->removeElement($worker)) {
            $worker->removeJob($this);
        }

        return $this;
    }
}
