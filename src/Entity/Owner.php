<?php

namespace App\Entity;

use App\Repository\OwnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
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
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255, options={"comment":"Наименование"})
     */
    private ?string $title;

    /**
     * @ORM\OneToMany(targetEntity=Camera::class, mappedBy="owner")
     */
    private ArrayCollection $cameras;

    public function __construct()
    {
        parent::__construct();

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
