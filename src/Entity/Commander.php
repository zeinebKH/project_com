<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommanderRepository")
 */
class Commander
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commande", inversedBy="commanders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Commander_Commande;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="commanders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Commander_Article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCommanderCommande(): ?Commande
    {
        return $this->Commander_Commande;
    }

    public function setCommanderCommande(?Commande $Commander_Commande): self
    {
        $this->Commander_Commande = $Commander_Commande;

        return $this;
    }

    public function getCommanderArticle(): ?Article
    {
        return $this->Commander_Article;
    }

    public function setCommanderArticle(?Article $Commander_Article): self
    {
        $this->Commander_Article = $Commander_Article;

        return $this;
    }
}
