<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\UserController;
use App\Controller\UserAvatarController;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => ['method' => 'get'],
        'post' => ['method' => 'post'],
        // 'controller' => UserAvatarController::class,
        // 'deserialize' => false,
        // "openapi_context" => [
        //     "requestBody" => [
        //         "required" => true,
        //         "content" => [
        //             "multipart/form-data" => [
        //                 "schema" => [
        //                     "type" => "object",
        //                     "properties" => [
        //                         "email" => [
        //                             "description" => "The email of the user",
        //                             "type" => "string",
        //                             "example" => "ClarkKent@gmail.com",
        //                         ],
        //                         "pseudo" => [
        //                             "description" => "The name of the user",
        //                             "type" => "string",
        //                             "example" => "Clark Kent",
        //                         ],
        //                         "password" => [
        //                             "description" => "The password of the user",
        //                             "type" => "string",
        //                             "example" => "supermanpassword25",
        //                         ],
        //                         "phone" => [
        //                             "description" => "The phone of the user",
        //                             "type" => "string",
        //                             "example" => "0707070707",
        //                         ],
        //                         "avatar" => [
        //                             "type" => "string",
        //                             "format" => "binary",
        //                             "description" => "Upload a cover image of the user",
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //         ],
        //     ],
        // ],
        // ],
        'me' => ['method' => 'get', 'controlleur' => UserController::class, 'path' => '/me'],

    ],
    itemOperations: [
        'get' => ['method' => 'get', 'requirements' => ['id' => '\d+'],],
        'put' => ['method' => 'put'],
        'delete' => ['method' => 'delete'],
    ],
    normalizationContext: ["groups" => "user:read"],
    denormalizationContext: ["groups" => "user:write"],
)]

#[UniqueEntity('pseudo')]
#[UniqueEntity('email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['user:read'])]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Groups(['user:read', 'user:write'])]
    private $email;

    #[ORM\Column(type: 'json', nullable: true)]
    #[Groups(['user:read'])]
    private $roles = [];

    /**
     * @Groups("user:write")
     *
     */
    #[
        SerializedName('password')
    ]
    #[Groups(['user:write'])]
    private $plainPassword;

    #[ORM\Column]
    #[Groups(['user:read', 'user:write'])]
    private $password;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['user:read', 'user:write'])]
    private $avatar;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['user:read', 'user:write'])]
    private $pseudo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['user:read', 'user:write'])]
    private $phone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
