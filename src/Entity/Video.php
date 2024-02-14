<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $videoFileName = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    private ?string $vimeoId = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $caption = null;

    #[ORM\Column]
    private ?bool $isPromoted = null;

    #[ORM\ManyToOne(inversedBy: 'videos')]
    private ?client $client = null;

    #[ORM\ManyToMany(targetEntity: tag::class, inversedBy: 'videos')]
    private Collection $tag;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVideoFileName(): ?string
    {
        return $this->videoFileName;
    }

    public function setVideoFileName(string $videoFileName): static
    {
        $this->videoFileName = $videoFileName;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getVimeoId(): ?string
    {
        return $this->vimeoId;
    }

    public function setVimeoId(string $vimeoId): static
    {
        $this->vimeoId = $vimeoId;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): static
    {
        $this->caption = $caption;

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

    /**
     * @return Collection<int, tag>
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(tag $tag): static
    {
        if (!$this->tag->contains($tag)) {
            $this->tag->add($tag);
        }

        return $this;
    }

    public function removeTag(tag $tag): static
    {
        $this->tag->removeElement($tag);

        return $this;
    }
}
