<?php

namespace App\Entity;

use App\Repository\UserMediaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserMediaRepository::class)
 */
class UserMedia
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nameUser;

    /**
     * @ORM\OneToOne(targetEntity=SocialMedia::class, cascade={"persist", "remove"})
     */
    private $media;

    /**
     * @ORM\ManyToOne(targetEntity=SocialMedia::class, inversedBy="userMedia")
     * @ORM\JoinColumn(nullable=false)
     */
    private $netMedia;

    /**
     * @ORM\ManyToOne(targetEntity=Member::class, inversedBy="userMedia")
     * @ORM\JoinColumn(nullable=false)
     */
    private $memberChurch;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameUser(): ?string
    {
        return $this->nameUser;
    }

    public function setNameUser(?string $nameUser): self
    {
        $this->nameUser = $nameUser;

        return $this;
    }

    public function getMedia(): ?SocialMedia
    {
        return $this->media;
    }

    public function setMedia(?SocialMedia $media): self
    {
        $this->media = $media;

        return $this;
    }

    public function getNetMedia(): ?SocialMedia
    {
        return $this->netMedia;
    }

    public function setNetMedia(?SocialMedia $netMedia): self
    {
        $this->netMedia = $netMedia;

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
