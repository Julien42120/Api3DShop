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
        'post' => [
            'controller' => CategoryImageController::class,
            'deserialize' => false,
            "openapi_context" => [
                "requestBody" => [
                    "required" => true,
                    "content" => [
                        "multipart/form-data" => [
                            "schema" => [
                                "type" => "object",
                                "properties" => [
                                    "category_id" => [
                                        "description" => "The category of the print",
                                        "type" => "string",
                                        "example" => "Toy",
                                    ],
                                    "user_id" => [
                                        "description" => "The user of the print",
                                        "type" => "string",
                                        "example" => "Toy",
                                    ],
                                    "material_id" => [
                                        "description" => "The material of the print",
                                        "type" => "string",
                                        "example" => "Toy",
                                    ],
                                    "title" => [
                                        "description" => "The title of the print",
                                        "type" => "string",
                                        "example" => "Toy",
                                    ],
                                    "description" => [
                                        "description" => "The description of the print",
                                        "type" => "string",
                                        "example" => "Toy",
                                    ],
                                    "price" => [
                                        "description" => "The price of the print",
                                        "type" => "string",
                                        "example" => "30",
                                    ],
                                    "default_size" => [
                                        "description" => "The size of the print",
                                        "type" => "int",
                                        "example" => "Toy",
                                    ],
                                    "default_weight" => [
                                        "description" => "The weight of the print",
                                        "type" => "string",
                                        "example" => "Toy",
                                    ],
                                    "images" => [
                                        "type" => "string",
                                        "format" => "binary",
                                        "description" => "images of the print",
                                    ],

                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
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
    #[Groups(['user:read', 'user:write'])]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user:read', 'user:write'])]
    private $description;

    #[ORM\Column(type: 'integer')]
    #[Groups(['user:read', 'user:write'])]
    private $price;

    #[ORM\Column(type: 'integer')]
    #[Groups(['user:read', 'user:write'])]
    private $default_size;

    #[ORM\Column(type: 'integer')]
    #[Groups(['user:read', 'user:write'])]
    private $default_weight;


    #[ORM\ManyToMany(targetEntity: Material::class, inversedBy: 'printings')]
    private $material;

    #[ORM\OneToMany(mappedBy: 'printing', targetEntity: ImagePrinting::class)]
    private $imagePrintings;



    public function __construct()
    {
        $this->material = new ArrayCollection();
        $this->imagePrintings = new ArrayCollection();
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
     * @return Collection<int, Material>
     */
    public function getMaterial(): Collection
    {
        return $this->material;
    }

    public function addMaterial(Material $material): self
    {
        if (!$this->material->contains($material)) {
            $this->material[] = $material;
        }

        return $this;
    }

    public function removeMaterial(Material $material): self
    {
        $this->material->removeElement($material);

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
}


// "openapi_context" => [
//                 "requestBody" => [
//                     "required" => true,
//                     "content" => [
//                         "multipart/form-data" => [
//                             "schema" => [
//                                 "type" => "object",
//                                 "properties" => [
//                                     "category_id" => [
//                                         "description" => "The category of the print",
//                                         "type" => "string",
//                                         "example" => "Toy",
//                                     ],
//                                     "user_id" => [
//                                         "description" => "The user of the print",
//                                         "type" => "string",
//                                         "example" => "Toy",
//                                     ],
//                                     "material_id" => [
//                                         "description" => "The material of the print",
//                                         "type" => "string",
//                                         "example" => "Toy",
//                                     ],
//                                     "title" => [
//                                         "description" => "The title of the print",
//                                         "type" => "string",
//                                         "example" => "Toy",
//                                     ],
//                                     "description" => [
//                                         "description" => "The description of the print",
//                                         "type" => "string",
//                                         "example" => "Toy",
//                                     ],
//                                     "price" => [
//                                         "description" => "The price of the print",
//                                         "type" => "string",
//                                         "example" => "30",
//                                     ],
//                                     "default_size" => [
//                                         "description" => "The size of the print",
//                                         "type" => "int",
//                                         "example" => "Toy",
//                                     ],
//                                     "default_weight" => [
//                                         "description" => "The weight of the print",
//                                         "type" => "string",
//                                         "example" => "Toy",
//                                     ],
//                                     "images" => [
//                                         "type" => "string",
//                                         "format" => "binary",
//                                         "description" => "images of the print",
//                                     ],
//                                     "options_size" => [
//                                         "type" => "string",
//                                         "format" => "string",
//                                         "description" => "option of the print size",
//                                     ],
//                                 ],
//                             ],
//                         ],
//                     ],
//                 ],
//             ],