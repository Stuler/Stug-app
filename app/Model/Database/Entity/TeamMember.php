<?php

namespace App\Model\Database\Entity;

use App\Model\Database\Entity\Attributes\Timestamps;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
class TeamMember extends AbstractEntity
{
    use Timestamps;

    #[Id, GeneratedValue, Column(type: "integer")]
    private $id;

    #[Column(type: "string", length: 255)]
    private $name;

    #[Column(type: "string", length: 255)]
    private $surname;

    #[ManyToOne(targetEntity: "App\Model\Database\Entity\MemberType", inversedBy: "teamMembers")]
    private $type;

    #[ManyToOne(targetEntity: "App\Model\Database\Entity\Team", inversedBy: "members")]
    private $team;

    public function __construct(string $name, string $surname, MemberType $type)
    {
        parent::__construct();
        $this->name = $name;
        $this->surname = $surname;
        $this->type = $type;
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

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getType(): MemberType
    {
        return $this->type;
    }

    public function setType(MemberType $type): void
    {
        $this->type = $type;
    }
}