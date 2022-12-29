<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PrintingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PrintingRepository::class)]
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

class Printing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['user:read'])]
    private $id;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['user:read'])]
    private $category;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['user:read'])]
    private $user;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user:read'])]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user:read'])]
    private $description;

    #[ORM\Column(type: 'integer')]
    #[Groups(['user:read'])]
    private $price;

    #[ORM\Column(type: 'integer')]
    #[Groups(['user:read'])]
    private $default_size;

    #[ORM\Column(type: 'integer')]
    #[Groups(['user:read'])]
    private $default_weight;

    #[ORM\OneToMany(mappedBy: 'printing', targetEntity: ImagePrinting::class)]
    #[Groups(['user:read'])]
    private $imagePrintings;

    #[ORM\ManyToOne(inversedBy: 'printings')]
    #[Groups(['user:read'])]
    private ?Material $default_material = null;

    #[ORM\Column]
    #[Groups(['user:read'])]
    private ?int $nbr_of_printing_hours = null;

    public function __construct()
    {
        $this->material = new ArrayCollection();
        $this->imagePrintings = new ArrayCollection();
        $this->configurations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDefaultSize(): ?int
    {
        return $this->default_size;
    }

    public function setDefaultSize(int $default_size): self
    {
        $this->default_size = $default_size;

        return $this;
    }

    public function getDefaultWeight(): ?int
    {
        return $this->default_weight;
    }

    public function setDefaultWeight(int $default_weight): self
    {
        $this->default_weight = $default_weight;

        return $this;
    }

    /**
     * @return Collection<int, ImagePrinting>
     */
    public function getImagePrintings(): Collection
    {
        return $this->imagePrintings;
    }

    public function addImagePrinting(ImagePrinting $imagePrinting): self
    {
        if (!$this->imagePrintings->contains($imagePrinting)) {
            $this->imagePrintings[] = $imagePrinting;
            $imagePrinting->setPrinting($this);
        }

        return $this;
    }

    public function removeImagePrinting(ImagePrinting $imagePrinting): self
    {
        if ($this->imagePrintings->removeElement($imagePrinting)) {
            // set the owning side to null (unless already changed)
            if ($imagePrinting->getPrinting() === $this) {
                $imagePrinting->setPrinting(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->title; // Remplacer champ par une propriété "string" de l'entité
    }

    public function getDefaultMaterial(): ?Material
    {
        return $this->default_material;
    }

    public function setDefaultMaterial(?Material $default_material): self
    {
        $this->default_material = $default_material;

        return $this;
    }

    public function getNbrOfPrintingHours(): ?int
    {
        return $this->nbr_of_printing_hours;
    }

    public function setNbrOfPrintingHours(int $nbr_of_printing_hours): self
    {
        $this->nbr_of_printing_hours = $nbr_of_printing_hours;

        return $this;
    }
}
