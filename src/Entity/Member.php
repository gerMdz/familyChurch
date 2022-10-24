<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MemberRepository::class)
 * @ORM\Table(name="`member`")
 */
class Member
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
    private $lastName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $dateOfBirthAt;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $sex;

    /**
     * @ORM\OneToOne(targetEntity=AddressMember::class, inversedBy="memberChurch", cascade={"persist", "remove"})
     */
    private $address;



    /**
     * @ORM\OneToMany(targetEntity=UserMedia::class, mappedBy="memberChurch")
     */
    private $userMedia;

    /**
     * @ORM\OneToMany(targetEntity=WayContact::class, mappedBy="memberChurch")
     */
    private $wayContacts;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $longAgo;

    /**
     * @ORM\ManyToMany(targetEntity=ChurchExperiences::class, inversedBy="members")
     */
    private $churchExperience;

    public function __construct()
    {
        $this->userMedia = new ArrayCollection();
        $this->wayContacts = new ArrayCollection();
        $this->churchExperience = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getDateOfBirthAt(): ?\DateTimeImmutable
    {
        return $this->dateOfBirthAt;
    }

    public function setDateOfBirthAt(?\DateTimeImmutable $dateOfBirthAt): self
    {
        $this->dateOfBirthAt = $dateOfBirthAt;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(?string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getAddress(): ?AddressMember
    {
        return $this->address;
    }

    public function setAddress(?AddressMember $address): self
    {
        $this->address = $address;

        return $this;
    }





    /**
     * @return Collection<int, UserMedia>
     */
    public function getUserMedia(): Collection
    {
        return $this->userMedia;
    }

    public function addUserMedium(UserMedia $userMedium): self
    {
        if (!$this->userMedia->contains($userMedium)) {
            $this->userMedia[] = $userMedium;
            $userMedium->setMemberChurch($this);
        }

        return $this;
    }

    public function removeUserMedium(UserMedia $userMedium): self
    {
        if ($this->userMedia->removeElement($userMedium)) {
            // set the owning side to null (unless already changed)
            if ($userMedium->getMemberChurch() === $this) {
                $userMedium->setMemberChurch(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WayContact>
     */
    public function getWayContacts(): Collection
    {
        return $this->wayContacts;
    }

    public function addWayContact(WayContact $wayContact): self
    {
        if (!$this->wayContacts->contains($wayContact)) {
            $this->wayContacts[] = $wayContact;
            $wayContact->setMemberChurch($this);
        }

        return $this;
    }

    public function removeWayContact(WayContact $wayContact): self
    {
        if ($this->wayContacts->removeElement($wayContact)) {
            // set the owning side to null (unless already changed)
            if ($wayContact->getMemberChurch() === $this) {
                $wayContact->setMemberChurch(null);
            }
        }

        return $this;
    }

    public function getLongAgo(): ?int
    {
        return $this->longAgo;
    }

    public function setLongAgo(?int $longAgo): self
    {
        $this->longAgo = $longAgo;

        return $this;
    }

    /**
     * @return Collection<int, ChurchExperiences>
     */
    public function getChurchExperience(): Collection
    {
        return $this->churchExperience;
    }

    public function addChurchExperience(ChurchExperiences $churchExperience): self
    {
        if (!$this->churchExperience->contains($churchExperience)) {
            $this->churchExperience[] = $churchExperience;
        }

        return $this;
    }

    public function removeChurchExperience(ChurchExperiences $churchExperience): self
    {
        $this->churchExperience->removeElement($churchExperience);

        return $this;
    }
}
