<?php

namespace App\Entity;

use App\Entity\Trait\SlugTrait;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[UniqueEntity('company')]
class Client
{
    use SlugTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(message: 'Le champ client ne peut pas être vide')]
    private ?string $company = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length(
        min: 10,
        minMessage: 'La tagline doit faire {{ limit }} caractères minimum.'
    )]
    private ?string $tagline = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(
        min: 10,
        minMessage: 'L\'avis client doit faire {{ limit }} caractères minimum.'
    )]
    private ?string $clientFeedback = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(
        min: 150,
        minMessage: 'La presentation du travail éffectué doit faire {{ limit }} caractères minimum.'
    )]
    private ?string $workPresentation = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Video::class)]
    private Collection $videos;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Picture::class)]
    private Collection $pictures;

    public function __construct()
    {
        $this->videos = new ArrayCollection();
        $this->pictures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getTagline(): ?string
    {
        return $this->tagline;
    }

    public function setTagline(string $tagline): static
    {
        $this->tagline = $tagline;

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

    public function getWorkPresentation(): ?string
    {
        return $this->workPresentation;
    }

    public function setWorkPresentation(?string $workPresentation): static
    {
        $this->workPresentation = $workPresentation;

        return $this;
    }

    /**
     * @return Collection<int, Video>
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): static
    {
        if (!$this->videos->contains($video)) {
            $this->videos->add($video);
            $video->setClient($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): static
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getClient() === $this) {
                $video->setClient(null);
            }
        }

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
            $picture->setClient($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): static
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getClient() === $this) {
                $picture->setClient(null);
            }
        }

        return $this;
    }
}
