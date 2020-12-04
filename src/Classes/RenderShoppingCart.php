<?php

namespace ShoppingCart\Classes;

class RenderShoppingCart
{
    public function renderItem($item)
    {
        $display = "<div class='col-sm-3 bg-dark p-2'>";
            $display .= "<div class='bg-light' style='width:30% height:500px; border-radius: 21px 21px 0 0'>";
                $display .= "<h6 class='ml-3 p-2 item-type'>" . ucwords($item->getClothingType()) . "</h6>";
                $display .= "<div class='row p-2'>";
                    $display .= "<img src='#' class='img-thumbnail ml-3 p-2'>";
                    $display .= "<div class='col-sm-12 d-flex'>";
                        $display .= "<ul class='list-group'>";
                        $display .= "<li class='item-type' hidden>type:" . $item->getClothingType() . "</li>";
                        $display .= "<li class='list-group-item item-price'>Price: £" .  number_format($item->getPrice(), 2) . "</li>";
                        $display .= "<li class='list-group-item item-colour'>Colour: " . ucfirst($item->getColour()) . "</li>";
                        $display .= "<li class='list-group-item item-material'>Material: " . ucfirst($item->getMaterial()) . "</li>";
                        $display .= "</ul>";
                    $display .= "</div>";
                $display .= "<button class='btn btn-primary ml-3 mt-2 add-item'>Select Item</button>";
                $display .= "</div>";
            $display .= "</div>";
        $display .= "</div>";

        return $display;
    }
}