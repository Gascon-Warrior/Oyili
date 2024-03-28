<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $videoFileName = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $label = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $vimeoId = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $caption = null;

    #[ORM\Column]
    private ?bool $isPromoted = null;

    #[ORM\ManyToOne(inversedBy: 'videos')]
    private ?Client $client = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'videos')]
    private Collection $tag;

    #[ORM\OneToMany(mappedBy: 'video', targetEntity: VideoJobWorker::class, orphanRemoval: true)]
    private Collection $videoJobWorkers;

    #[ORM\Column]
    private ?bool $is_cover = null;
    
    #[Assert\Length(
        min: 10,
        minMessage: 'L\'avis client doit faire {{ limit }} caractères minimum.'
    )]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $clientFeedback = null;

    #[ORM\OneToMany(mappedBy: 'video', targetEntity: Picture::class)]
    private Collection $pictures;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
        $this->videoJobWorkers = new ArrayCollection();
        $this->pictures = new ArrayCollection();
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

    public function addTag(Tag $tag): static
    {
        if (!$this->tag->contains($tag)) {
            $this->tag->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tag->removeElement($tag);

        return $this;
    }

    /**
     * @return Collection<int, VideoJobWorker>
     */
    public function getVideoJobWorkers(): Collection
    {
        return $this->videoJobWorkers;
    }

    public function addVideoJobWorker(VideoJobWorker $videoJobWorker): static
    {
        if (!$this->videoJobWorkers->contains($videoJobWorker)) {
            $this->videoJobWorkers->add($videoJobWorker);
            $videoJobWorker->setVideo($this);
        }

        return $this;
    }

    public function removeVideoJobWorker(VideoJobWorker $videoJobWorker): static
    {
        if ($this->videoJobWorkers->removeElement($videoJobWorker)) {
            // set the owning side to null (unless already changed)
            if ($videoJobWorker->getVideo() === $this) {
                $videoJobWorker->setVideo(null);
            }
        }

        return $this;
    }

    public function isIsCover(): ?bool
    {
        return $this->is_cover;
    }

    public function setIsCover(bool $is_cover): static
    {
        $this->is_cover = $is_cover;

        return $this;
    }

    public function getClientFeedback(): ?string
    {
        return $this->clientFeedback;
    }

    public function setClientFeedback(?string $clientFeedback): static
    {
        $this->clientFeedback = $clientFeedback;

        return $this;
    }

    /**
     * @return Collection<int, Picture>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): static
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
            $picture->setVideo($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): static
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getVideo() === $this) {
                $picture->setVideo(null);
            }
        }

        return $this;
    }
}
