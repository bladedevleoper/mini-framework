<?php

namespace ShoppingCart\Classes;

use JetBrains\PhpStorm\Pure;
use ShoppingCart\Factory\ClothesFactory;

class ShoppingList
{
    public RenderShoppingCart $render;

    #[Pure] public function __construct()
    {
        $this->render = new RenderShoppingCart();
    }

    public function getShoppingItems(): array
    {

        $shoppingItems = shoppingList();
        $list = [];
        if (isset($shoppingItems)) {
            foreach ($shoppingItems as $item) {
                $list[] = ClothesFactory::make($item['type'], $item['clothing_details']);
            }
        }

        return $list;

    }
}