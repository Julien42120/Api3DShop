<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\AllPrintingsController;
use App\Controller\ImagePrintingController;
use App\Controller\PrintingController;
use App\Repository\ImagePrintingRepository;
use App\Repository\PrintingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ImagePrintingRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => ['method' => 'get'],
        'post' => [
            'controller' => ImagePrintingController::class,
            'deserialize' => false,
            "openapi_context" => [
                "requestBody" => [
                    "required" => true,
                    "content" => [
                        "multipart/form-data" => [
                            "schema" => [
                                "type" => "object",
                                "properties" => [
                                    "printing" => [
                                        'type' => 'string',
                                        // 'enum' => [(AllPrintingsController::class)],
                                        'example' => 'server1',
                                        'description' => 'Server to select',
                                        'required' => true
                                    ],
                                    "image" => [
                                        "type" => "string",
                                        "format" => "binary",
                                        "description" => "Upload a cover image of the print",
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
        'get' => ['method' => 'get', 'requirements' => ['id' => '\d+'],]
    ],
    normalizationContext: ["groups" => "user:read"],
    denormalizationContext: ["groups" => "user:write"],
)]
class ImagePrinting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Printing::class, inversedBy: 'imagePrintings')]
    #[Groups(['user:write'])]
    private $printing;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user:read', 'user:write'])]
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrinting(): ?Printing
    {
        return $this->printing;
    }

    public function setPrinting(?Printing $printing): self
    {
        $this->printing = $printing;

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
