<?php

namespace App\Classes;

use App\Factory\ClothesFactory;

class ShoppingListController
{
    /**
     * @var ShoppingList
     */
    private ShoppingList $shoppingList;
    /**
     * @var RenderShoppingCart
     */
    public RenderShoppingCart $renderShoppingCart;

    public function __construct()
    {
        $this->shoppingList = new ShoppingList();
        $this->renderShoppingCart = new RenderShoppingCart();
    }

    public function index()
    {
        $shoppingItems = [];

        foreach($this->shoppingList->getShoppingItems() as $item) {
           $shoppingItems[] = $this->renderShoppingCart->renderItem($item);
        }

        return view('shopping-cart/shopping-list', [
            'shoppingList' => $shoppingItems,
        ]);
    }


}