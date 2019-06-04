<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Player
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlayerDeckLink", mappedBy="player")
     */
    private $playerDeckLinks;

    public function __construct()
    {
        $this->playerDeckLinks = new ArrayCollection();
    }

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

    /**
     * @return Collection|PlayerDeckLink[]
     */
    public function getPlayerDeckLinks(): Collection
    {
        return $this->playerDeckLinks;
    }

    public function addPlayerDeckLink(PlayerDeckLink $playerDeckLink): self
    {
        if (!$this->playerDeckLinks->contains($playerDeckLink)) {
            $this->playerDeckLinks[] = $playerDeckLink;
            $playerDeckLink->setPlayer($this);
        }

        return $this;
    }

    public function removePlayerDeckLink(PlayerDeckLink $playerDeckLink): self
    {
        if ($this->playerDeckLinks->contains($playerDeckLink)) {
            $this->playerDeckLinks->removeElement($playerDeckLink);
            // set the owning side to null (unless already changed)
            if ($playerDeckLink->getPlayer() === $this) {
                $playerDeckLink->setPlayer(null);
            }
        }

        return $this;
    }
}
