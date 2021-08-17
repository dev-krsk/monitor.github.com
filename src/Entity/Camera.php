<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CameraRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CameraRepository::class)
 * @ORM\Table(name="cameras", options={"comment":"Таблица камер видеонаблюдения"})
 */
class Camera extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"comment":"Ключевое поле"})
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255, options={"comment":"Наименование камеры"})
     */
    private ?string $title;

    /**
     * @ORM\Column(type="float", options={"comment":"Широта"})
     */
    private ?float $latitude;

    /**
     * @ORM\Column(type="float", options={"comment":"Долгота"})
     */
    private ?float $longitude;

    /**
     * @ORM\Column(type="float", options={"comment":"Угол", "default":"0"})
     */
    private ?float $angle = 0;

    /**
     * @ORM\Column(type="string", length=255, options={"comment":"Ссылка на транслюцию"})
     */
    private ?string $source;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"comment":"Ссылка на превью"})
     */
    private ?string $preview;

    /**
     * @ORM\ManyToOne(targetEntity=Owner::class, inversedBy="cameras")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Owner $owner;

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

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getAngle(): ?float
    {
        return $this->angle;
    }

    public function setAngle(float $angle): self
    {
        $this->angle = $angle;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getPreview(): ?string
    {
        return $this->preview;
    }

    public function setPreview(?string $preview): self
    {
        $this->preview = $preview;

        return $this;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(?Owner $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
