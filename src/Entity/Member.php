<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MemberRepository::class)
 * @ORM\Table(name="member_church")
 */
class Member
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     * @Groups({"main"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"main"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"main"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $dateOfBirthAt;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
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

    /**
     * @ORM\ManyToMany(targetEntity=ServicesChurch::class, inversedBy="members")
     */
    private $servicesUsed;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isParticipateSmallGroup;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $smallGroupName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $smallGroupGuide;

    /**
     * @ORM\ManyToMany(targetEntity=EnjoyGroup::class)
     */
    private $enjoyMost;

    /**
     * @ORM\ManyToMany(targetEntity=AreaInterest::class)
     */
    private $yourAreaInterest;

    /**
     * @ORM\ManyToMany(targetEntity=Needs::class)
     */
    private $yourNeeds;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isServeChurch;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $whereServeChurch;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tradeProfession;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $workExperience;

    /**
     * @ORM\Column(type="string", length=510, nullable=true)
     */
    private $artisticSkills;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $currentOccupation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $familyGroup;

    /**
     * @ORM\Column(type="string", length=510, nullable=true)
     */
    private $filePath;

    public function __toString(): string
    {
        return $this->firstName . ' '. $this->getLastName();
    }

    public function __construct()
    {
        $this->userMedia = new ArrayCollection();
        $this->wayContacts = new ArrayCollection();
        $this->churchExperience = new ArrayCollection();
        $this->servicesUsed = new ArrayCollection();
        $this->enjoyMost = new ArrayCollection();
        $this->yourAreaInterest = new ArrayCollection();
        $this->yourNeeds = new ArrayCollection();
    }

    public function getId(): ?UuidInterface
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

    public function getDateOfBirthAt(): ?DateTimeImmutable
    {
        return $this->dateOfBirthAt;
    }

    public function setDateOfBirthAt(?DateTimeImmutable $dateOfBirthAt): self
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

    /**
     * @return Collection<int, ServicesChurch>
     */
    public function getServicesUsed(): Collection
    {
        return $this->servicesUsed;
    }

    public function addServicesUsed(ServicesChurch $servicesUsed): self
    {
        if (!$this->servicesUsed->contains($servicesUsed)) {
            $this->servicesUsed[] = $servicesUsed;
        }

        return $this;
    }

    public function removeServicesUsed(ServicesChurch $servicesUsed): self
    {
        $this->servicesUsed->removeElement($servicesUsed);

        return $this;
    }

    public function isIsParticipateSmallGroup(): ?bool
    {
        return $this->isParticipateSmallGroup;
    }

    public function setIsParticipateSmallGroup(?bool $isParticipateSmallGroup): self
    {
        $this->isParticipateSmallGroup = $isParticipateSmallGroup;

        return $this;
    }

    public function getSmallGroupName(): ?string
    {
        return $this->smallGroupName;
    }

    public function setSmallGroupName(?string $smallGroupName): self
    {
        $this->smallGroupName = $smallGroupName;

        return $this;
    }

    public function getSmallGroupGuide(): ?string
    {
        return $this->smallGroupGuide;
    }

    public function setSmallGroupGuide(?string $smallGroupGuide): self
    {
        $this->smallGroupGuide = $smallGroupGuide;

        return $this;
    }

    /**
     * @return Collection<int, EnjoyGroup>
     */
    public function getEnjoyMost(): Collection
    {
        return $this->enjoyMost;
    }

    public function addEnjoyMost(EnjoyGroup $enjoyMost): self
    {
        if (!$this->enjoyMost->contains($enjoyMost)) {
            $this->enjoyMost[] = $enjoyMost;
        }

        return $this;
    }

    public function removeEnjoyMost(EnjoyGroup $enjoyMost): self
    {
        $this->enjoyMost->removeElement($enjoyMost);

        return $this;
    }

    /**
     * @return Collection<int, AreaInterest>
     */
    public function getYourAreaInterest(): Collection
    {
        return $this->yourAreaInterest;
    }

    public function addYourAreaInterest(AreaInterest $yourAreaInterest): self
    {
        if (!$this->yourAreaInterest->contains($yourAreaInterest)) {
            $this->yourAreaInterest[] = $yourAreaInterest;
        }

        return $this;
    }

    public function removeYourAreaInterest(AreaInterest $yourAreaInterest): self
    {
        $this->yourAreaInterest->removeElement($yourAreaInterest);

        return $this;
    }

    /**
     * @return Collection<int, Needs>
     */
    public function getYourNeeds(): Collection
    {
        return $this->yourNeeds;
    }

    public function addYourNeed(Needs $yourNeed): self
    {
        if (!$this->yourNeeds->contains($yourNeed)) {
            $this->yourNeeds[] = $yourNeed;
        }

        return $this;
    }

    public function removeYourNeed(Needs $yourNeed): self
    {
        $this->yourNeeds->removeElement($yourNeed);

        return $this;
    }

    public function isIsServeChurch(): ?bool
    {
        return $this->isServeChurch;
    }

    public function setIsServeChurch(?bool $isServeChurch): self
    {
        $this->isServeChurch = $isServeChurch;

        return $this;
    }

    public function getWhereServeChurch(): ?string
    {
        return $this->whereServeChurch;
    }

    public function setWhereServeChurch(?string $whereServeChurch): self
    {
        $this->whereServeChurch = $whereServeChurch;

        return $this;
    }

    public function getTradeProfession(): ?string
    {
        return $this->tradeProfession;
    }

    public function setTradeProfession(?string $tradeProfession): self
    {
        $this->tradeProfession = $tradeProfession;

        return $this;
    }

    public function getWorkExperience(): ?string
    {
        return $this->workExperience;
    }

    public function setWorkExperience(?string $workExperience): self
    {
        $this->workExperience = $workExperience;

        return $this;
    }

    public function getArtisticSkills(): ?string
    {
        return $this->artisticSkills;
    }

    public function setArtisticSkills(?string $artisticSkills): self
    {
        $this->artisticSkills = $artisticSkills;

        return $this;
    }

    public function getCurrentOccupation(): ?string
    {
        return $this->currentOccupation;
    }

    public function setCurrentOccupation(?string $currentOccupation): self
    {
        $this->currentOccupation = $currentOccupation;

        return $this;
    }

    public function getFamilyGroup(): ?string
    {
        return $this->familyGroup;
    }

    public function setFamilyGroup(?string $familyGroup): self
    {
        $this->familyGroup = $familyGroup;

        return $this;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(?string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }
}
