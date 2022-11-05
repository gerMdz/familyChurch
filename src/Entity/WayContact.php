<?php

namespace App\Entity;

use App\Repository\WayContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=WayContactRepository::class)
 */
class WayContact
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
     * @ORM\Column(type="string", length=100)
     */
    private $valueContact;

    /**
     * @ORM\ManyToOne(targetEntity=ContactTypes::class, inversedBy="wayContacts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeContact;

    /**
     * @ORM\ManyToOne(targetEntity=Member::class, inversedBy="wayContacts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $memberChurch;

    public function __toString()
    {
     return $this->valueContact;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getValueContact(): ?string
    {
        return $this->valueContact;
    }

    public function setValueContact(string $valueContact): self
    {
        $this->valueContact = $valueContact;

        return $this;
    }

    public function getTypeContact(): ?ContactTypes
    {
        return $this->typeContact;
    }

    public function setTypeContact(?ContactTypes $typeContact): self
    {
        $this->typeContact = $typeContact;

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
