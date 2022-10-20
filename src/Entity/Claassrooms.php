<?php

namespace App\Entity;

use App\Repository\ClaassroomsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

   

    #[ORM\OneToMany(mappedBy: 'claassrooms', targetEntity: Student::class)]
    private Collection $studentss;

    public function __construct()
    {
        $this->studentss = new ArrayCollection();
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

    public function getNbStudent(): ?int
    {
        return $this->nbStudent;
    }

    public function setNbStudent(int $nbStudent): self
    {
        $this->nbStudent = $nbStudent;

        return $this;
    }

  
    /**
     * @return Collection<int, Student>
     */
    public function getStudentss(): Collection
    {
        return $this->studentss;
    }

    public function addStudentss(Student $studentss): self
    {
        if (!$this->studentss->contains($studentss)) {
            $this->studentss->add($studentss);
            $studentss->setClaassrooms($this);
        }

        return $this;
    }

    public function removeStudentss(Student $studentss): self
    {
        if ($this->studentss->removeElement($studentss)) {
            // set the owning side to null (unless already changed)
            if ($studentss->getClaassrooms() === $this) {
                $studentss->setClaassrooms(null);
            }
        }

        return $this;
    }

    public function __toString() { 
        return(string)$this->getName(); }

}
