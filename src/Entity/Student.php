<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]

    #[ORM\Column(length: 255)]
    private ?string $ref = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'studentss')]
    #[ORM\JoinColumn(onDelete:"CASCADE")]
    private ?Claassrooms $claassrooms = null;

    public function getRef(): ?string
    {
        return $this->ref;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getClaassrooms(): ?Claassrooms
    {
        return $this->claassrooms;
    }

    public function setClaassrooms(?Claassrooms $claassrooms): self
    {
        $this->claassrooms = $claassrooms;

        return $this;
    }
}
