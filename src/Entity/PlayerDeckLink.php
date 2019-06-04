<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class PlayerDeckLink
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Deck", inversedBy="playerDeckLinks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $deck;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Player", inversedBy="playerDeckLinks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\Column(type="boolean")
     */
    private $win = false;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeck(): ?Deck
    {
        return $this->deck;
    }

    public function setDeck(?Deck $deck): self
    {
        $this->deck = $deck;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getWin(): ?bool
    {
        return $this->win;
    }

    public function setWin(bool $win): self
    {
        $this->win = $win;

        return $this;
    }
}
