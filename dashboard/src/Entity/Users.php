<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $google_token;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $facebook_token;

    /**
     * @ORM\Column(type="boolean")
     */
    private $facebook_auth;


    /**
     * @ORM\Column(type="boolean")
     */
    private $google_auth;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Enabled;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CheckToken;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    public function setRole(array $role): self
    {
        $this->roles = $role;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setGoogle_token(string $token): self
    {
        $this->google_token = $token;

        return $this;
    }

    public function getGoogle_token(): ?string
    {
        return $this->google_token;
    }

    public function setFacebook_token(string $token): self
    {
        $this->facebook_token = $token;

        return $this;
    }

    public function getFacebook_token(): ?string
    {
        return $this->facebook_token;
    }

    public function setFacebook_auth(bool $token): self
    {
        $this->facebook_auth = $token;

        return $this;
    }

    public function getFacebook_auth(): bool
    {
        return $this->facebook_auth;
    }

    public function setGoogle_auth($google_auth): self
    {
        $this->google_auth = $google_auth;

        return $this;
    }

    public function getGoogle_auth(): ?string
    {
        return $this->google_auth;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getEnabled(): bool
    {
        return $this->Enabled;
    }

    public function setEnabled(bool $Enabled): self
    {
        $this->Enabled = $Enabled;

        return $this;
    }

    public function getCheckToken(): ?string
    {
        return $this->CheckToken;
    }

    public function setCheckToken(?string $CheckToken): self
    {
        $this->CheckToken = $CheckToken;

        return $this;
    }
}
