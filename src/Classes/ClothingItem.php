<?php

namespace ShoppingCart\Classes;


class ClothingItem
{
    private $type;
    private $colour;
    private $material;
    private $price = 0;
    private $clothingType;

    public function __construct(array $item)
    {
        $this->type = $item['type'];
        $this->colour = $item['colour'];
        $this->material = $item['material'];
        $this->price = $item['price'];
        $this->clothingType = str_replace('_', ' ', $item['clothing_type']);
    }

    public function returnItem()
    {
        return (object)[
            'type' => $this->getType(),
            'colour' => $this->getColour(),
            'material' => $this->getMaterial(),
            'price' => '£' . $this->getPrice()
         ];
    }

    public function getType()
    {
        return $this->type;
    }

    public function getColour()
    {
        return $this->colour;
    }

    public function getMaterial()
    {
        return $this->material;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getClothingType()
    {
        return $this->type . ' ' . $this->clothingType;
    }
}
