<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MaterialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MaterialRepository::class)]
#[ApiResource(
    normalizationContext: ["groups" => "user:read"],
    denormalizationContext: ["groups" => "user:write"],
)]

class Material
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['user:read', 'user:write'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user:read', 'user:write'])]
    private $type_name;

    #[ORM\Column(type: 'float')]
    #[Groups(['user:read', 'user:write'])]
    private $lenght;

    #[ORM\Column(type: 'float')]
    #[Groups(['user:read', 'user:write'])]
    private $density;

    #[ORM\Column(type: 'integer')]
    #[Groups(['user:read', 'user:write'])]
    private $price_per_kg;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['user:read', 'user:write'])]
    private $color;

    #[Groups(['user:read', 'user:write'])]
    #[ORM\ManyToMany(targetEntity: Printing::class, mappedBy: 'material')]
    private $printings;


    public function __construct()
    {
        $this->printings = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Printing>
     */
    public function getPrintings(): Collection
    {
        return $this->printings;
    }

    public function addPrinting(Printing $printing): self
    {
        if (!$this->printings->contains($printing)) {
            $this->printings[] = $printing;
            $printing->addMaterial($this);
        }

        return $this;
    }

    public function removePrinting(Printing $printing): self
    {
        if ($this->printings->removeElement($printing)) {
            $printing->removeMaterial($this);
        }

        return $this;
    }
}
