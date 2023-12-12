<?php

namespace App\Model\Database\Entity\Attributes;

use Doctrine\ORM\Mapping\Column;

trait Timestamps
{
    #[Column(type: "datetime")]
    private $createdAt;

    #[Column(type: "datetime", nullable: true)]
    private $deletedAt;

    #[Column(type: "datetime")]
    private $modifiedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->modifiedAt = new \DateTime();
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getDeletedAt(): ?\DateTime
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTime $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

    public function getModifiedAt(): \DateTime
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(\DateTime $modifiedAt): void
    {
        $this->modifiedAt = $modifiedAt;
    }
}