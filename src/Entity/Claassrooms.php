<?php

namespace App\Entity;

use App\Repository\ClaassroomsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClaassroomsRepository::class)]
class Claassrooms
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $nbStudent = null;

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

    public function getNbStudent(): ?int
    {
        return $this->nbStudent;
    }

    public function setNbStudent(int $nbStudent): self
    {
        $this->nbStudent = $nbStudent;

        return $this;
    }
}
