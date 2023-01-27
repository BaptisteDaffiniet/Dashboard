<?php

namespace App\Entity;

use App\Repository\DeviseConversionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeviseConversionRepository::class)
 */
class DeviseConversion
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
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $devise_target;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $devise_format;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $service_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $timer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getDeviseTarget(): ?string
    {
        return $this->devise_target;
    }

    public function setDeviseTarget(string $devise_target): self
    {
        $this->devise_target = $devise_target;

        return $this;
    }

    public function getDeviseFormat(): ?string
    {
        return $this->devise_format;
    }

    public function setDeviseFormat(string $devise_format): self
    {
        $this->devise_format = $devise_format;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getServiceName(): ?string
    {
        return $this->service_name;
    }

    public function setServiceName(string $service_name): self
    {
        $this->service_name = $service_name;

        return $this;
    }

    public function getTimer(): ?int
    {
        return $this->timer;
    }

    public function setTimer(int $timer): self
    {
        $this->timer = $timer;

        return $this;
    }
}
