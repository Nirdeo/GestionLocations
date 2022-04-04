<?php

namespace App\Entity;

use App\Repository\RentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RentRepository::class)]
class Rent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $inventoryFile;

    #[ORM\Column(type: 'datetime')]
    private $arrivalDate;

    #[ORM\Column(type: 'datetime')]
    private $departureDate;

    #[ORM\Column(type: 'text', nullable: true)]
    private $firstTenantComments;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $firstTenantSignature;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $firstTenantValidatedAt;

    #[ORM\Column(type: 'text', nullable: true)]
    private $secondTenantComments;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $secondTenantSignature;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $secondTenantValidatedAt;

    #[ORM\Column(type: 'text', nullable: true)]
    private $firstRepresentativeComments;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $firstRepresentativeSignature;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $firstRepresentativeValidatedAt;

    #[ORM\Column(type: 'text', nullable: true)]
    private $secondRepresentativeComments;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $secondRepresentativeSignature;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $secondRepresentativeValidatedAt;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'rents')]
    #[ORM\JoinColumn(nullable: false)]
    private $tenant;

    #[ORM\ManyToOne(targetEntity: Residence::class, inversedBy: 'rents')]
    #[ORM\JoinColumn(nullable: false)]
    private $residence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInventoryFile(): ?string
    {
        return $this->inventoryFile;
    }

    public function setInventoryFile(?string $inventoryFile): self
    {
        $this->inventoryFile = $inventoryFile;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(\DateTimeInterface $arrivalDate): self
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    public function getDepartureDate(): ?\DateTimeInterface
    {
        return $this->departureDate;
    }

    public function setDepartureDate(\DateTimeInterface $departureDate): self
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    public function getFirstTenantComments(): ?string
    {
        return $this->firstTenantComments;
    }

    public function setFirstTenantComments(string $firstTenantComments): self
    {
        $this->firstTenantComments = $firstTenantComments;

        return $this;
    }

    public function getFirstTenantSignature(): ?string
    {
        return $this->firstTenantSignature;
    }

    public function setFirstTenantSignature(string $firstTenantSignature): self
    {
        $this->firstTenantSignature = $firstTenantSignature;

        return $this;
    }

    public function getFirstTenantValidatedAt(): ?\DateTimeInterface
    {
        return $this->firstTenantValidatedAt;
    }

    public function setFirstTenantValidatedAt(\DateTimeInterface $firstTenantValidatedAt): self
    {
        $this->firstTenantValidatedAt = $firstTenantValidatedAt;

        return $this;
    }

    public function getFirstRepresentativeComments(): ?string
    {
        return $this->firstRepresentativeComments;
    }

    public function setFirstRepresentativeComments(string $firstRepresentativeComments): self
    {
        $this->firstRepresentativeComments = $firstRepresentativeComments;

        return $this;
    }

    public function getFirstRepresentativeSignature(): ?string
    {
        return $this->firstRepresentativeSignature;
    }

    public function setFirstRepresentativeSignature(string $firstRepresentativeSignature): self
    {
        $this->firstRepresentativeSignature = $firstRepresentativeSignature;

        return $this;
    }

    public function getFirstRepresentativeValidatedAt(): ?\DateTimeInterface
    {
        return $this->firstRepresentativeValidatedAt;
    }

    public function setFirstRepresentativeValidatedAt(\DateTimeInterface $firstRepresentativeValidatedAt): self
    {
        $this->firstRepresentativeValidatedAt = $firstRepresentativeValidatedAt;

        return $this;
    }

    public function getSecondTenantComments(): ?string
    {
        return $this->secondTenantComments;
    }

    public function setSecondTenantComments(string $secondTenantComments): self
    {
        $this->secondTenantComments = $secondTenantComments;

        return $this;
    }

    public function getSecondTenantSignature(): ?string
    {
        return $this->secondTenantSignature;
    }

    public function setSecondTenantSignature(string $secondTenantSignature): self
    {
        $this->secondTenantSignature = $secondTenantSignature;

        return $this;
    }

    public function getSecondTenantValidatedAt(): ?\DateTimeInterface
    {
        return $this->secondTenantValidatedAt;
    }

    public function setSecondTenantValidatedAt(\DateTimeInterface $secondTenantValidatedAt): self
    {
        $this->secondTenantValidatedAt = $secondTenantValidatedAt;

        return $this;
    }

    public function getSecondRepresentativeComments(): ?string
    {
        return $this->secondRepresentativeComments;
    }

    public function setSecondRepresentativeComments(string $secondRepresentativeComments): self
    {
        $this->secondRepresentativeComments = $secondRepresentativeComments;

        return $this;
    }

    public function getSecondRepresentativeSignature(): ?string
    {
        return $this->secondRepresentativeSignature;
    }

    public function setSecondRepresentativeSignature(string $secondRepresentativeSignature): self
    {
        $this->secondRepresentativeSignature = $secondRepresentativeSignature;

        return $this;
    }

    public function getSecondRepresentativeValidatedAt(): ?\DateTimeInterface
    {
        return $this->secondRepresentativeValidatedAt;
    }

    public function setSecondRepresentativeValidatedAt(\DateTimeInterface $secondRepresentativeValidatedAt): self
    {
        $this->secondRepresentativeValidatedAt = $secondRepresentativeValidatedAt;

        return $this;
    }

    public function getTenant(): ?User
    {
        return $this->tenant;
    }

    public function setTenant(?User $tenant): self
    {
        $this->tenant = $tenant;

        return $this;
    }

    public function getResidence(): ?Residence
    {
        return $this->residence;
    }

    public function setResidence(?Residence $residence): self
    {
        $this->residence = $residence;

        return $this;
    }
}
