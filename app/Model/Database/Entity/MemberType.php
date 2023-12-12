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
class MemberType extends AbstractEntity
{
    use Timestamps;

    #[Id, GeneratedValue, Column(type: "integer")]
    private $id;

    #[Column(type: "string", length: 255)]
    private $type;

    #[OneToMany(mappedBy: "type", targetEntity: "App\Model\Database\Entity\TeamMember")]
    private $teamMembers;

    public function __construct(string $type)
    {
        parent::__construct();
        $this->type = $type;
        $this->teamMembers = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getTeamMembers(): Collection
    {
        return $this->teamMembers;
    }

    public function addTeamMember(TeamMember $teamMember): void
    {
        if (!$this->teamMembers->contains($teamMember)) {
            $this->teamMembers[] = $teamMember;
            $teamMember->setType($this);
        }
    }

    public function removeTeamMember(TeamMember $teamMember): void
    {
        if ($this->teamMembers->removeElement($teamMember)) {
            if ($teamMember->getType() === $this) {
                $teamMember->setType(null);
            }
        }
    }
}