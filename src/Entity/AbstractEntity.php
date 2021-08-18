<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 */
#[ORM\MappedSuperclass]
#[ORM\HasLifecycleCallbacks]
abstract class AbstractEntity
{
    /**
     * @ORM\Column(type="datetime_immutable", options={"comment":"Дата создания"})
     */
    private ?DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", options={"comment":"Дата изменения"})
     */
    private ?DateTimeImmutable $updatedAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true, options={"comment":"Дата удаления"})
     */
    private ?DateTimeImmutable $deletedAt;

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    #[ORM\PrePersist]
    public function setCreatedAtCallback(): self
    {
        $this->createdAt = new DateTimeImmutable('now');

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setUpdatedAtCallback(): self
    {
        $this->updatedAt = new DateTimeImmutable('now');

        return $this;
    }

    public function getDeletedAt(): ?DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?DateTimeImmutable $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}