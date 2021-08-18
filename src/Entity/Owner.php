<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OwnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="owners:list"}}},
 *     paginationEnabled=false
 * )
 *
 * @ORM\Entity(repositoryClass=OwnerRepository::class)
 * @ORM\Table(name="owners", schema="public", options={"comment":"Таблица владельцев"})
 */
class Owner extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"comment":"Ключевое поле"})
     */
    #[Groups(['owners:list'])]
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255, options={"comment":"Наименование"})
     */
    #[Groups(['owners:list'])]
    private ?string $title;

    /**
     * @ORM\OneToMany(targetEntity=Camera::class, mappedBy="owner")
     */
    private Collection $cameras;

    #[Pure] public function __construct()
    {
        $this->cameras = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Camera[]
     */
    public function getCameras(): Collection|array
    {
        return $this->cameras;
    }

    public function addCamera(Camera $camera): self
    {
        if (!$this->cameras->contains($camera)) {
            $this->cameras[] = $camera;
            $camera->setOwner($this);
        }

        return $this;
    }

    public function removeCamera(Camera $camera): self
    {
        if ($this->cameras->removeElement($camera) && $camera->getOwner() === $this) {
            $camera->setOwner(null);
        }

        return $this;
    }
}
