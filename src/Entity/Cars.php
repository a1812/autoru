<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarsRepository")
 * @ORM\Table(indexes={
 *      @ORM\Index(name="nameIdx", columns={"name"}),
 * })
 */
class Cars
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
     * @ORM\ManyToOne(targetEntity="Marka", fetch="EAGER")
     */
    private $marka;

    /**
     * @ORM\ManyToOne(targetEntity="Model", fetch="EAGER")
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity="Generation", fetch="EAGER")
     */
    private $generation;


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

    public function getMarka(): ?Marka
    {
        return $this->marka;
    }

    public function setMarka(?Marka $marka): self
    {
        $this->marka = $marka;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getGeneration(): ?Generation
    {
        return $this->generation;
    }

    public function setGeneration(?Generation $generation): self
    {
        $this->generation = $generation;

        return $this;
    }
}
