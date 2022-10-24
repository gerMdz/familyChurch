<?php

namespace App\Entity;

use App\Repository\FamilyMemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FamilyMemberRepository::class)
 */
class FamilyMember
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=RelationalSituation::class, inversedBy="familyMembers")
     */
    private $relationalSituation;

    /**
     * @ORM\ManyToMany(targetEntity=CoexistenceSituation::class)
     */
    private $coexistenceSituation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isChildren;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberChildren;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isChildrenAttendChurch;

    public function __construct()
    {
        $this->relationalSituation = new ArrayCollection();
        $this->coexistenceSituation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, RelationalSituation>
     */
    public function getRelationalSituation(): Collection
    {
        return $this->relationalSituation;
    }

    public function addRelationalSituation(RelationalSituation $relationalSituation): self
    {
        if (!$this->relationalSituation->contains($relationalSituation)) {
            $this->relationalSituation[] = $relationalSituation;
        }

        return $this;
    }

    public function removeRelationalSituation(RelationalSituation $relationalSituation): self
    {
        $this->relationalSituation->removeElement($relationalSituation);

        return $this;
    }

    /**
     * @return Collection<int, CoexistenceSituation>
     */
    public function getCoexistenceSituation(): Collection
    {
        return $this->coexistenceSituation;
    }

    public function addCoexistenceSituation(CoexistenceSituation $coexistenceSituation): self
    {
        if (!$this->coexistenceSituation->contains($coexistenceSituation)) {
            $this->coexistenceSituation[] = $coexistenceSituation;
        }

        return $this;
    }

    public function removeCoexistenceSituation(CoexistenceSituation $coexistenceSituation): self
    {
        $this->coexistenceSituation->removeElement($coexistenceSituation);

        return $this;
    }

    public function isIsChildren(): ?bool
    {
        return $this->isChildren;
    }

    public function setIsChildren(?bool $isChildren): self
    {
        $this->isChildren = $isChildren;

        return $this;
    }

    public function getNumberChildren(): ?int
    {
        return $this->numberChildren;
    }

    public function setNumberChildren(?int $numberChildren): self
    {
        $this->numberChildren = $numberChildren;

        return $this;
    }

    public function isIsChildrenAttendChurch(): ?bool
    {
        return $this->isChildrenAttendChurch;
    }

    public function setIsChildrenAttendChurch(?bool $isChildrenAttendChurch): self
    {
        $this->isChildrenAttendChurch = $isChildrenAttendChurch;

        return $this;
    }
}
