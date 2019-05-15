<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieWorkerRepository")
 */
class MovieWorker
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Movie", inversedBy="movieWorkers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fk_movie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="movieWorkers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fk_person;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Job", inversedBy="movieWorkers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fk_job;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getFkPerson(): ?Person
    {
        return $this->fk_person;
    }

    public function setFkPerson(?Person $fk_person): self
    {
        $this->fk_person = $fk_person;

        return $this;
    }

    public function getFkJob(): ?Job
    {
        return $this->fk_job;
    }

    public function setFkJob(?Job $fk_job): self
    {
        $this->fk_job = $fk_job;

        return $this;
    }
}
