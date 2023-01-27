<?php

namespace App\Entity;

use App\Repository\SteamAppNewsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SteamAppNewsRepository::class)
 */
class SteamAppNews
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
    private $game_id;

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

    public function getGameId(): ?string
    {
        return $this->game_id;
    }

    public function setGameId(string $game_id): self
    {
        $this->game_id = $game_id;

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
