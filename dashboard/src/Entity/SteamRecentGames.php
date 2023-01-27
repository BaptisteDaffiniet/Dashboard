<?php

namespace App\Entity;

use App\Repository\SteamRecentGamesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SteamRecentGamesRepository::class)
 */
class SteamRecentGames
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
    private $profileid;

    /**
     * @ORM\Column(type="integer")
     */
    private $gamenumber;

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

    public function getProfileid(): ?string
    {
        return $this->profileid;
    }

    public function setProfileid(string $profileid): self
    {
        $this->profileid = $profileid;

        return $this;
    }

    public function getGamenumber(): ?int
    {
        return $this->gamenumber;
    }

    public function setGamenumber(int $gamenumber): self
    {
        $this->gamenumber = $gamenumber;

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
