<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 */
class Movie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $release_date;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $length;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poster;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $trailer;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $synopsis;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $budget;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $box_office;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentary", mappedBy="fk_movie")
     */
    private $fk_commentary;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MovieWorker", mappedBy="fk_movie")
     */
    private $movieWorkers;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $language;


    public function __construct()
    {
        $this->fk_commentary = new ArrayCollection();
        $this->movieWorkers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->release_date;
    }

    public function setReleaseDate(?\DateTimeInterface $release_date): self
    {
        $this->release_date = $release_date;

        return $this;
    }

    public function getLength(): ?\DateTimeInterface
    {
        return $this->length;
    }

    public function setLength(?\DateTimeInterface $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function getTrailer(): ?string
    {
        return $this->trailer;
    }

    public function setTrailer(?string $trailer): self
    {
        $this->trailer = $trailer;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(?int $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getBoxOffice(): ?int
    {
        return $this->box_office;
    }

    public function setBoxOffice(?int $box_office): self
    {
        $this->box_office = $box_office;

        return $this;
    }

    /**
     * @return Collection|Commentary[]
     */
    public function getFkCommentary(): Collection
    {
        return $this->fk_commentary;
    }

    public function addFkCommentary(Commentary $fkCommentary): self
    {
        if (!$this->fk_commentary->contains($fkCommentary)) {
            $this->fk_commentary[] = $fkCommentary;
            $fkCommentary->setFkMovie($this);
        }

        return $this;
    }

    public function removeFkCommentary(Commentary $fkCommentary): self
    {
        if ($this->fk_commentary->contains($fkCommentary)) {
            $this->fk_commentary->removeElement($fkCommentary);
            // set the owning side to null (unless already changed)
            if ($fkCommentary->getFkMovie() === $this) {
                $fkCommentary->setFkMovie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MovieWorker[]
     */
    public function getMovieWorkers(): Collection
    {
        return $this->movieWorkers;
    }

    public function addMovieWorker(MovieWorker $movieWorker): self
    {
        if (!$this->movieWorkers->contains($movieWorker)) {
            $this->movieWorkers[] = $movieWorker;
            $movieWorker->setFkMovie($this);
        }

        return $this;
    }

    public function removeMovieWorker(MovieWorker $movieWorker): self
    {
        if ($this->movieWorkers->contains($movieWorker)) {
            $this->movieWorkers->removeElement($movieWorker);
            // set the owning side to null (unless already changed)
            if ($movieWorker->getFkMovie() === $this) {
                $movieWorker->setFkMovie(null);
            }
        }

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

}
