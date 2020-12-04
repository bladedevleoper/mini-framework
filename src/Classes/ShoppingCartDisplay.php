<?php

namespace ShoppingCart\Classes;

class ShoppingCartDisplay
{
    private $shoppingList;

    public function __construct(ShoppingList $list)
    {
        $this->shoppingList = $list;
    }

    public function numberOfItemsOnDisplay()
    {
        return count($this->shoppingList);
    }

    public function displayCart()
    {
        foreach($this->shoppingList as $item) {
            echo $item;
        }
    }

}