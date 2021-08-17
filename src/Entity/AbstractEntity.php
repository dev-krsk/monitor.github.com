<?php

namespace App\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass()
 */
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

    /**
     * AbstractEntity constructor.
     */
    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable('now');
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
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