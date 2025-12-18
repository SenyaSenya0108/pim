<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PropertyValueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropertyValueRepository::class)]
#[ApiResource]
class PropertyValue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $value = null;

    #[ORM\ManyToOne(cascade: ['persist'], inversedBy: 'propertyValues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\ManyToOne(cascade: ['persist'], inversedBy: 'propertyValues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Property $property = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getProperty(): ?Property
    {
        return $this->property;
    }

    public function setProperty(?Property $property): static
    {
        $this->property = $property;

        return $this;
    }
}
