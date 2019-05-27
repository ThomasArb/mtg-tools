<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PlayerDeckLink")
     */
    private $players;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\PlayerDeckLink", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $winner;

    public function __construct()
    {
        $this->players = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|PlayerDeckLink[]
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(PlayerDeckLink $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
        }

        return $this;
    }

    public function removePlayer(PlayerDeckLink $player): self
    {
        if ($this->players->contains($player)) {
            $this->players->removeElement($player);
        }

        return $this;
    }

    public function getWinner(): ?PlayerDeckLink
    {
        return $this->winner;
    }

    public function setWinner(PlayerDeckLink $winner): self
    {
        $this->winner = $winner;

        return $this;
    }
}
