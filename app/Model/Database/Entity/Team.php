<?php

namespace App\Model\Database\Entity;

use App\Model\Database\Entity\Attributes\Timestamps;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
class Team extends AbstractEntity
{
    use Timestamps;

    #[Id, GeneratedValue, Column(type: "integer")]
    private $id;

    #[Column(type: "string", length: 255)]
    private $name;

    #[OneToMany(mappedBy: "team", targetEntity: "App\Model\Database\Entity\TeamMember")]
    private $members;

    public function __construct()
    {
        parent::__construct();
        $this->members = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(TeamMember $member): void
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
            $member->setTeam($this);
        }
    }

    public function removeMember(TeamMember $member): void
    {
        $this->members->removeElement($member);
    }

    public function getMembersCount(): int
    {
        return $this->members->count();
    }

    public function getMembersByType(string $type): Collection
    {
        return $this->members->filter(function (TeamMember $member) use ($type) {
            return $member->getType()->getType() === $type;
        });
    }
}