<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 15, nullable: true)]
    private $phoneNumber;

    #[ORM\ManyToMany(targetEntity: Glasses::class, mappedBy: 'customer')]
    private $glasses;

    #[ORM\ManyToMany(targetEntity: Glasses::class, inversedBy: 'users')]
    private $wearList;

    public function __construct()
    {
        $this->glasses = new ArrayCollection();
        $this->wearList = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return Collection|Glasses[]
     */
    public function getGlasses(): Collection
    {
        return $this->glasses;
    }

    public function addGlass(Glasses $glass): self
    {
        if (!$this->glasses->contains($glass)) {
            $this->glasses[] = $glass;
            $glass->addCustomer($this);
        }

        return $this;
    }

    public function removeGlass(Glasses $glass): self
    {
        if ($this->glasses->removeElement($glass)) {
            $glass->removeCustomer($this);
        }

        return $this;
    }

    /**
     * @return Collection|Glasses[]
     */
    public function getWearList(): Collection
    {
        return $this->wearList;
    }

    public function addWearList(Glasses $wearList): self
    {
        if (!$this->wearList->contains($wearList)) {
            $this->wearList[] = $wearList;
        }

        return $this;
    }

    public function removeWearList(Glasses $wearList): self
    {
        $this->wearList->removeElement($wearList);

        return $this;
    }

    public function isInWearlist(Glasses $glass): bool
    {
        if ($this->wearList->contains($glass)){
            return true;
        }
        else{
            return false;
        }
    }
}
