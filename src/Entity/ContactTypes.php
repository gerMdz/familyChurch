<?php

namespace App\Entity;

use App\Repository\ContactTypesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactTypesRepository::class)
 */
class ContactTypes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $identifier;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $typeInput;

    /**
     * @ORM\ManyToOne(targetEntity=Member::class, inversedBy="contacto")
     */
    private $memberChurch;

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

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(?string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getTypeInput(): ?string
    {
        return $this->typeInput;
    }

    public function setTypeInput(?string $typeInput): self
    {
        $this->typeInput = $typeInput;

        return $this;
    }

    public function getMemberChurch(): ?Member
    {
        return $this->memberChurch;
    }

    public function setMemberChurch(?Member $memberChurch): self
    {
        $this->memberChurch = $memberChurch;

        return $this;
    }
}
