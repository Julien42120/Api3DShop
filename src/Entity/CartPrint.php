<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CartPrintRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CartPrintRepository::class)]
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
class CartPrint
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:read'])]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['user:read', 'user:write'])]
    private ?Printing $printing = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['user:read', 'user:write'])]
    private ?Material $material = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrinting(): ?Printing
    {
        return $this->printing;
    }

    public function setPrinting(Printing $printing): self
    {
        $this->printing = $printing;

        return $this;
    }

    public function getMaterial(): ?Material
    {
        return $this->material;
    }

    public function setMaterial(Material $material): self
    {
        $this->material = $material;

        return $this;
    }
}
