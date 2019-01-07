<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaryRepository")
 */
class Commentary
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
    private $pseudo;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_datetime;

    /**
     * @ORM\Column(type="smallint")
     */
    private $score;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Movie", inversedBy="fk_commentary")
     */
    private $fk_movie;

    public function __construct()
    {
        $this->movie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getCreatedDatetime(): ?\DateTimeImmutable
    {
        return $this->created_datetime;
    }

    public function setCreatedDatetime(\DateTimeImmutable $created_datetime): self
    {
        $this->created_datetime = $created_datetime;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return Collection|Movie[]
     */
    public function getMovie(): Collection
    {
        return $this->movie;
    }

    public function addMovie(Movie $movie): self
    {
        if (!$this->movie->contains($movie)) {
            $this->movie[] = $movie;
            $movie->setFkCommentary($this);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): self
    {
        if ($this->movie->contains($movie)) {
            $this->movie->removeElement($movie);
            // set the owning side to null (unless already changed)
            if ($movie->getFkCommentary() === $this) {
                $movie->setFkCommentary(null);
            }
        }

        return $this;
    }

    public function getFkMovie(): ?Movie
    {
        return $this->fk_movie;
    }

    public function setFkMovie(?Movie $fk_movie): self
    {
        $this->fk_movie = $fk_movie;

        return $this;
    }
}
