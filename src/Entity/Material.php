<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MaterialRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterialRepository::class)]
#[ApiResource]
class Material
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $type_name;

    #[ORM\Column(type: 'float')]
    private $lenght;

    #[ORM\Column(type: 'float')]
    private $density;

    #[ORM\Column(type: 'integer')]
    private $price_per_kg;

    #[ORM\Column(type: 'string', length: 50)]
    private $color;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeName(): ?string
    {
        return $this->type_name;
    }

    public function setTypeName(string $type_name): self
    {
        $this->type_name = $type_name;

        return $this;
    }

    public function getLenght(): ?float
    {
        return $this->lenght;
    }

    public function setLenght(float $lenght): self
    {
        $this->lenght = $lenght;

        return $this;
    }

    public function getDensity(): ?float
    {
        return $this->density;
    }

    public function setDensity(float $density): self
    {
        $this->density = $density;

        return $this;
    }

    public function getPricePerKg(): ?int
    {
        return $this->price_per_kg;
    }

    public function setPricePerKg(int $price_per_kg): self
    {
        $this->price_per_kg = $price_per_kg;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }
}
