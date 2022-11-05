<?php

namespace App\Entity;

use App\Repository\AddressMemberRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=AddressMemberRepository::class)
 */
class AddressMember
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $numeration;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $secondLine;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $neighborhood;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $neighborhoodBlock;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $houseNumber;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $country;

    /**
     * @ORM\OneToOne(targetEntity=Member::class, mappedBy="address", cascade={"persist", "remove"})
     */
    private $memberChurch;

    public function __toString()
    {
     return $this->street;
    }

    public function getId(): ?UuidInterface
    {
        return $this->id;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getNumeration(): ?string
    {
        return $this->numeration;
    }

    public function setNumeration(?string $numeration): self
    {
        $this->numeration = $numeration;

        return $this;
    }

    public function getSecondLine(): ?string
    {
        return $this->secondLine;
    }

    public function setSecondLine(?string $secondLine): self
    {
        $this->secondLine = $secondLine;

        return $this;
    }

    public function getNeighborhood(): ?string
    {
        return $this->neighborhood;
    }

    public function setNeighborhood(?string $neighborhood): self
    {
        $this->neighborhood = $neighborhood;

        return $this;
    }

    public function getNeighborhoodBlock(): ?string
    {
        return $this->neighborhoodBlock;
    }

    public function setNeighborhoodBlock(?string $neighborhoodBlock): self
    {
        $this->neighborhoodBlock = $neighborhoodBlock;

        return $this;
    }

    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(?string $houseNumber): self
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getMemberChurch(): ?Member
    {
        return $this->memberChurch;
    }

    public function setMemberChurch(?Member $memberChurch): self
    {
        // unset the owning side of the relation if necessary
        if ($memberChurch === null && $this->memberChurch !== null) {
            $this->memberChurch->setAddress(null);
        }

        // set the owning side of the relation if necessary
        if ($memberChurch !== null && $memberChurch->getAddress() !== $this) {
            $memberChurch->setAddress($this);
        }

        $this->memberChurch = $memberChurch;

        return $this;
    }
}
