<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CategoryImageController;
use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity(repositoryClass: CategoryRepository::class)]
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
                                    "category" => [
                                        "description" => "The name of the category",
                                        "type" => "string",
                                        "example" => "Toy",
                                    ],
                                    "image" => [
                                        "type" => "string",
                                        "format" => "binary",
                                        "description" => "Upload a cover image of the category",
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

)]

class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $category;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

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
