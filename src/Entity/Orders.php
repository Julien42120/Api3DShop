<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
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
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['user:read', 'user:write'])]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[Groups(['user:read', 'user:write'])]
    private $user;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user:read', 'user:write'])]
    private $billing_address;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user:read', 'user:write'])]
    private $delivery_address;

    #[ORM\ManyToMany(targetEntity: Printing::class)]
    #[Groups(['user:write', 'user:read'])]
    private $printing;

    #[ORM\Column(type: 'integer')]
<<<<<<< HEAD:src/Entity/Orders.php
    #[Groups(['user:read', 'user:write'])]
=======
    #[Groups(['user:write', 'user:read'])]
>>>>>>> bdd13e7b8126fa97572a95bc97e63690f3b847d4:src/Entity/Order.php
    private $final_price;

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

    public function getFinalPrice(): ?int
    {
        return $this->final_price;
    }

    public function setFinalPrice(int $final_price): self
    {
        $this->final_price = $final_price;

        return $this;
    }
}
