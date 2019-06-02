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
    private $playerDeckLinks;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\PlayerDeckLink", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $winner;

    public function __construct()
    {
        $this->playerDeckLinks = new ArrayCollection();
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
    public function getPlayerDeckLinks(): Collection
    {
        return $this->playerDeckLinks;
    }

    public function addPlayerDeckLinks(PlayerDeckLink $playerDeckLink): self
    {
        if (!$this->playerDeckLinks->contains($playerDeckLink)) {
            $this->playerDeckLinks[] = $playerDeckLink;
        }

        return $this;
    }

    public function removePlayer(PlayerDeckLink $playerDeckLink): self
    {
        if ($this->playerDeckLinks->contains($playerDeckLink)) {
            $this->playerDeckLinks->removeElement($playerDeckLink);
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
