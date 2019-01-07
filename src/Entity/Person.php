<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person
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
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationality;

    /**
     * @ORM\Column(type="date")
     */
    private $born;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biography;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MovieWorker", mappedBy="fk_person")
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

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getBorn(): ?\DateTimeInterface
    {
        return $this->born;
    }

    public function setBorn(\DateTimeInterface $born): self
    {
        $this->born = $born;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

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
            $movieWorker->setFkPerson($this);
        }

        return $this;
    }

    public function removeMovieWorker(MovieWorker $movieWorker): self
    {
        if ($this->movieWorkers->contains($movieWorker)) {
            $this->movieWorkers->removeElement($movieWorker);
            // set the owning side to null (unless already changed)
            if ($movieWorker->getFkPerson() === $this) {
                $movieWorker->setFkPerson(null);
            }
        }

        return $this;
    }


   
}
