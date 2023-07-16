<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Repository\EnnemyRepository;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnnemyRepository::class)]
class Ennemy
{
    // Trait
    use CreatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $waifu = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $atk = null;

    #[ORM\Column]
    private ?int $hp = null;

    #[ORM\ManyToOne(inversedBy: 'ennemies')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?User $user = null;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWaifu(): ?string
    {
        return $this->waifu;
    }

    public function setWaifu(string $waifu): static
    {
        $this->waifu = $waifu;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAtk(): ?int
    {
        return $this->atk;
    }

    public function setAtk(int $atk): static
    {
        $this->atk = $atk;

        return $this;
    }

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(int $hp): static
    {
        $this->hp = $hp;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}