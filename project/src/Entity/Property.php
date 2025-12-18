<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
class Property
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 20)]
    private ?string $unit = null;

    /**
     * @var Collection<int, PropertyValue>
     */
    #[ORM\OneToMany(targetEntity: PropertyValue::class, mappedBy: 'property', orphanRemoval: true)]
    private Collection $propertyValues;

    public function __construct()
    {
        $this->propertyValues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): static
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * @return Collection<int, PropertyValue>
     */
    public function getPropertyValues(): Collection
    {
        return $this->propertyValues;
    }

    public function addPropertyValue(PropertyValue $propertyValue): static
    {
        if (!$this->propertyValues->contains($propertyValue)) {
            $this->propertyValues->add($propertyValue);
            $propertyValue->setProperty($this);
        }

        return $this;
    }

    public function removePropertyValue(PropertyValue $propertyValue): static
    {
        if ($this->propertyValues->removeElement($propertyValue)) {
            // set the owning side to null (unless already changed)
            if ($propertyValue->getProperty() === $this) {
                $propertyValue->setProperty(null);
            }
        }

        return $this;
    }
}
