<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobRepository")
 */
class Job
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MovieWorker", mappedBy="fk_job")
     */
    private $movieWorkers;

    public function __construct()
    {
        $this->movieWorkers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $movieWorker->setFkJob($this);
        }

        return $this;
    }

    public function removeMovieWorker(MovieWorker $movieWorker): self
    {
        if ($this->movieWorkers->contains($movieWorker)) {
            $this->movieWorkers->removeElement($movieWorker);
            // set the owning side to null (unless already changed)
            if ($movieWorker->getFkJob() === $this) {
                $movieWorker->setFkJob(null);
            }
        }

        return $this;
    }

    
}
