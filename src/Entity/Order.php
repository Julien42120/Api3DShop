<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
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
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['user:read', 'user:write'])]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[Groups(['user:read'])]
    private $user;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user:read', 'user:write'])]
    private $billing_address;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user:read', 'user:write'])]
    private $delivery_address;

    #[ORM\ManyToMany(targetEntity: Printing::class)]
    #[Groups(['user:read', 'user:write'])]
    private $printing;

    public function __construct()
    {
        $this->printing = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Printing>
     */
    public function getPrinting(): Collection
    {
        return $this->printing;
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

    public function getBillingAddress(): ?string
    {
        return $this->billing_address;
    }

    public function setBillingAddress(string $billing_address): self
    {
        $this->billing_address = $billing_address;

        return $this;
    }

    public function getDeliveryAddress(): ?string
    {
        return $this->delivery_address;
    }

    public function setDeliveryAddress(string $delivery_address): self
    {
        $this->delivery_address = $delivery_address;

        return $this;
    }

    public function addPrinting(Printing $printing): self
    {
        if (!$this->printing->contains($printing)) {
            $this->printing[] = $printing;
        }

        return $this;
    }

    public function removePrinting(Printing $printing): self
    {
        $this->printing->removeElement($printing);

        return $this;
    }
}
