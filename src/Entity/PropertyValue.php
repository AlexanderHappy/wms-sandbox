<?php

namespace App\Entity;

use App\Repository\PropertyValueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropertyValueRepository::class)]
class PropertyValue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $value_string = null;

    #[ORM\Column(nullable: true)]
    private ?int $value_int = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 24, scale: 8, nullable: true)]
    private ?string $value_decimal = null;

    #[ORM\Column(nullable: true)]
    private ?bool $value_boolean = null;

    #[ORM\ManyToOne(inversedBy: 'propertyValues')]
    private ?PropertyList $property_list_id = null;

    #[ORM\ManyToOne(inversedBy: 'propertyValues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Properties $property_id = null;

    #[ORM\ManyToOne(inversedBy: 'propertyValues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Inventories $inventory_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValueString(): ?string
    {
        return $this->value_string;
    }

    public function setValueString(?string $value_string): static
    {
        $this->value_string = $value_string;

        return $this;
    }

    public function getValueInt(): ?int
    {
        return $this->value_int;
    }

    public function setValueInt(?int $value_int): static
    {
        $this->value_int = $value_int;

        return $this;
    }

    public function getValueDecimal(): ?string
    {
        return $this->value_decimal;
    }

    public function setValueDecimal(?string $value_decimal): static
    {
        $this->value_decimal = $value_decimal;

        return $this;
    }

    public function isValueBoolean(): ?bool
    {
        return $this->value_boolean;
    }

    public function setValueBoolean(?bool $value_boolean): static
    {
        $this->value_boolean = $value_boolean;

        return $this;
    }

    public function getValueListId(): ?PropertyList
    {
        return $this->property_list_id;
    }

    public function setValueListId(?PropertyList $property_list_id): static
    {
        $this->property_list_id = $property_list_id;

        return $this;
    }

    public function getPropertyId(): ?Properties
    {
        return $this->property_id;
    }

    public function setPropertyId(?Properties $property_id): static
    {
        $this->property_id = $property_id;

        return $this;
    }

    public function getInventoryId(): ?Inventories
    {
        return $this->inventory_id;
    }

    public function setInventoryId(?Inventories $inventory_id): static
    {
        $this->inventory_id = $inventory_id;

        return $this;
    }
}
