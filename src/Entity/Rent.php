<?php

namespace App\Entity;

use App\Repository\RentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RentRepository::class)]
class Rent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $tenant_id;

    #[ORM\Column(type: 'integer')]
    private $residence_id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $inventory_file;

    #[ORM\Column(type: 'datetime')]
    private $arrival_date;

    #[ORM\Column(type: 'datetime')]
    private $departure_date;

    #[ORM\Column(type: 'text')]
    private $tenant_comments;

    #[ORM\Column(type: 'string', length: 255)]
    private $tenant_signature;

    #[ORM\Column(type: 'string', length: 45)]
    private $tenant_validated_at;

    #[ORM\Column(type: 'text')]
    private $representative_comments;

    #[ORM\Column(type: 'string', length: 255)]
    private $representative_signature;

    #[ORM\Column(type: 'datetime')]
    private $representative_validated_at;

    #[ORM\OneToMany(mappedBy: 'rent', targetEntity: User::class, orphanRemoval: true)]
    private $users;

    #[ORM\OneToMany(mappedBy: 'rent', targetEntity: Residence::class)]
    private $residences;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->residences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTenantId(): ?int
    {
        return $this->tenant_id;
    }

    public function setTenantId(int $tenant_id): self
    {
        $this->tenant_id = $tenant_id;

        return $this;
    }

    public function getResidenceId(): ?int
    {
        return $this->residence_id;
    }

    public function setResidenceId(int $residence_id): self
    {
        $this->residence_id = $residence_id;

        return $this;
    }

    public function getInventoryFile(): ?string
    {
        return $this->inventory_file;
    }

    public function setInventoryFile(?string $inventory_file): self
    {
        $this->inventory_file = $inventory_file;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrival_date;
    }

    public function setArrivalDate(\DateTimeInterface $arrival_date): self
    {
        $this->arrival_date = $arrival_date;

        return $this;
    }

    public function getDepartureDate(): ?\DateTimeInterface
    {
        return $this->departure_date;
    }

    public function setDepartureDate(\DateTimeInterface $departure_date): self
    {
        $this->departure_date = $departure_date;

        return $this;
    }

    public function getTenantComments(): ?string
    {
        return $this->tenant_comments;
    }

    public function setTenantComments(string $tenant_comments): self
    {
        $this->tenant_comments = $tenant_comments;

        return $this;
    }

    public function getTenantSignature(): ?string
    {
        return $this->tenant_signature;
    }

    public function setTenantSignature(string $tenant_signature): self
    {
        $this->tenant_signature = $tenant_signature;

        return $this;
    }

    public function getTenantValidatedAt(): ?string
    {
        return $this->tenant_validated_at;
    }

    public function setTenantValidatedAt(string $tenant_validated_at): self
    {
        $this->tenant_validated_at = $tenant_validated_at;

        return $this;
    }

    public function getRepresentativeComments(): ?string
    {
        return $this->representative_comments;
    }

    public function setRepresentativeComments(string $representative_comments): self
    {
        $this->representative_comments = $representative_comments;

        return $this;
    }

    public function getRepresentativeSignature(): ?string
    {
        return $this->representative_signature;
    }

    public function setRepresentativeSignature(string $representative_signature): self
    {
        $this->representative_signature = $representative_signature;

        return $this;
    }

    public function getRepresentativeValidatedAt(): ?\DateTimeInterface
    {
        return $this->representative_validated_at;
    }

    public function setRepresentativeValidatedAt(\DateTimeInterface $representative_validated_at): self
    {
        $this->representative_validated_at = $representative_validated_at;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setRent($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getRent() === $this) {
                $user->setRent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Residence[]
     */
    public function getResidences(): Collection
    {
        return $this->residences;
    }

    public function addResidence(Residence $residence): self
    {
        if (!$this->residences->contains($residence)) {
            $this->residences[] = $residence;
            $residence->setRent($this);
        }

        return $this;
    }

    public function removeResidence(Residence $residence): self
    {
        if ($this->residences->removeElement($residence)) {
            // set the owning side to null (unless already changed)
            if ($residence->getRent() === $this) {
                $residence->setRent(null);
            }
        }

        return $this;
    }
}
