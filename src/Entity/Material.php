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
    collectionOperations: [
        'get' => ['method' => 'get'],
        'post' => ['method' => 'post'],
    ],
    itemOperations: [
        'get' => ['method' => 'get'],
    ],
    normalizationContext: ["groups" => "user:read"],
    denormalizationContext: ["groups" => "user:write"],
)]

class Material
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['user:read'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user:read'])]
    private $type_name;

    #[ORM\Column(type: 'float')]
    #[Groups(['user:read'])]
    private $lenght;

    #[ORM\Column(type: 'float')]
    #[Groups(['user:read'])]
    private $density;

    #[ORM\Column(type: 'integer')]
    #[Groups(['user:read'])]
    private $price_per_kg;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['user:read'])]
    private $color;

    #[ORM\OneToMany(mappedBy: 'default_material', targetEntity: Printing::class)]
    private Collection $printings;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user:read'])]
    private $image;

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

    public function __toString()
    {
        return $this->color; // Remplacer champ par une propriété "string" de l'entité
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
            $this->printings->add($printing);
            $printing->setDefaultMaterial($this);
        }

        return $this;
    }

    public function removePrinting(Printing $printing): self
    {
        if ($this->printings->removeElement($printing)) {
            // set the owning side to null (unless already changed)
            if ($printing->getDefaultMaterial() === $this) {
                $printing->setDefaultMaterial(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
