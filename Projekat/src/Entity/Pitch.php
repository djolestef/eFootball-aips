<?php

namespace App\Entity;

use App\Repository\PitchRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PitchRepository::class)
 */
class Pitch
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    /**
     * @ORM\Column(type="integer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dimensions;

    /**
     * @ORM\Column(type="boolean")
     * @ORM\JoinColumn(nullable=false)
     */
    private $miniGoals;

    /**
     * @ORM\Column(type="boolean")
     * @ORM\JoinColumn(nullable=false)
     */
    private $balls;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?int
    {
        return $this->company;
    }

    public function setCompany(int $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }


    public function getDimensions(): ?int
    {
        return $this->dimensions;
    }

    public function setDimensions(int $dimensions): self
    {
        $this->dimensions = $dimensions;

        return $this;
    }

    public function hasMiniGoals(): ?bool
    {
        return $this->miniGoals;
    }

    public function setMiniGoals(bool $miniGoals): self
    {
        $this->miniGoals = $miniGoals;

        return $this;
    }

    public function hasBalls(): ?bool
    {
        return $this->balls;
    }

    public function setBalls(bool $balls): self
    {
        $this->balls = $balls;

        return $this;
    }
}

