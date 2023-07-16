<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\UpdatedAtTrait;
use App\Repository\UserRepository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email.')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    // Trait
    use CreatedAtTrait;
    use UpdatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank(message: 'Email field can\'t be empty.')]
    #[Assert\Length(min: 5, max: 30,
        minMessage: 'Email shoud have at least {{ limit }} characters.',
        maxMessage: 'Email shoud have no more than {{ limit }} characters.')]
    #[Assert\Email(message: 'Email {{ value }} is not a valid email.')]
    private ?string $email = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: 'Name field can\'t be empty.')]
    #[Assert\Length(min: 3, max: 20,
        minMessage: 'Name shoud have at least {{ limit }} characters.',
        maxMessage: 'Name shoud have no more than {{ limit }} characters.')]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $avatar = null;

    #[ORM\Column(length: 255)]
    private ?int $level = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Waifu::class, orphanRemoval: true)]
    private Collection $waifus;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Ennemy::class, orphanRemoval: true)]
    private Collection $ennemies;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Chapter::class, orphanRemoval: true)]
    private Collection $chapters;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->updated_at = new \DateTimeImmutable();
        $this->waifus = new ArrayCollection();
        $this->ennemies = new ArrayCollection();
        $this->chapters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

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

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): static
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): static
    {
        $this->level = $level;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Waifu>
     */
    public function getWaifus(): Collection
    {
        return $this->waifus;
    }

    public function addWaifu(Waifu $waifu): static
    {
        if (!$this->waifus->contains($waifu))
        {
            $this->waifus->add($waifu);
            $waifu->setUser($this);
        }

        return $this;
    }

    public function removeWaifu(Waifu $waifu): static
    {
        if ($this->waifus->removeElement($waifu))
        {
            // set the owning side to null (unless already changed)
            if ($waifu->getUser() === $this)
            {
                $waifu->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ennemy>
     */
    public function getEnnemies(): Collection
    {
        return $this->ennemies;
    }

    public function addEnnemy(Ennemy $ennemy): static
    {
        if (!$this->ennemies->contains($ennemy))
        {
            $this->ennemies->add($ennemy);
            $ennemy->setUser($this);
        }

        return $this;
    }

    public function removeEnnemy(Ennemy $ennemy): static
    {
        if ($this->ennemies->removeElement($ennemy))
        {
            // set the owning side to null (unless already changed)
            if ($ennemy->getUser() === $this)
            {
                $ennemy->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Chapter>
     */
    public function getChapters(): Collection
    {
        return $this->chapters;
    }

    public function addChapter(Chapter $chapter): static
    {
        if (!$this->chapters->contains($chapter)) {
            $this->chapters->add($chapter);
            $chapter->setUser($this);
        }

        return $this;
    }

    public function removeChapter(Chapter $chapter): static
    {
        if ($this->chapters->removeElement($chapter)) {
            // set the owning side to null (unless already changed)
            if ($chapter->getUser() === $this) {
                $chapter->setUser(null);
            }
        }

        return $this;
    }
}