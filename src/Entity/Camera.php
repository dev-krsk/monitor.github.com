<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CameraRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CameraRepository::class)
 * @ORM\Table(name="cameras", options={"comment":"Таблица камер видеонаблюдения"})
 */
#[ApiResource(
    collectionOperations: ['get' => [
        'normalization_context' => [
            'groups' => 'cameras:list'
        ]
    ]],
    paginationClientEnabled: false
)]
class Camera extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"comment":"Ключевое поле"})
     */
    #[Groups(['cameras:list'])]
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255, options={"comment":"Наименование камеры"})
     */
    #[Groups(['cameras:list'])]
    private ?string $title;

    /**
     * @ORM\Column(type="float", options={"comment":"Широта"})
     */
    #[Groups(['cameras:list'])]
    private ?float $latitude;

    /**
     * @ORM\Column(type="float", options={"comment":"Долгота"})
     */
    #[Groups(['cameras:list'])]
    private ?float $longitude;

    /**
     * @ORM\Column(type="float", options={"comment":"Угол", "default":"0"})
     */
    #[Groups(['cameras:list'])]
    private ?float $angle = 0;

    /**
     * @ORM\Column(type="string", length=255, options={"comment":"Ссылка на транслюцию"})
     */
    #[Groups(['cameras:list'])]
    private ?string $source;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"comment":"Ссылка на превью"})
     */
    #[Groups(['cameras:list'])]
    private ?string $preview;

    /**
     * @ORM\ManyToOne(targetEntity=Owner::class, inversedBy="cameras")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Owner $owner;

    /**
     * @ORM\Column(type="integer", options={"comment":"Идентификатор камеры у владельца"})
     */
    private ?int $key;

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

    public function getKey(): ?int
    {
        return $this->key;
    }

    public function setKey(int $key): self
    {
        $this->key = $key;

        return $this;
    }
}
