<?php

use ShoppingCart\Classes\ShoppingList;

$shoppingList = new ShoppingList();

if (isset($_COOKIE['shopping_list'])) {
    $savedItems = json_decode($_COOKIE['shopping_list'], true);
} else {
    $savedItems = [];
}
?>
<div class="container">
<div class="row">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill ml-3 shopping-cart-count">
                <?php
                if (isset($savedItems['total_items'])) {
                        echo $savedItems['total_items'];
                    } else {
                        echo 0;
                    }
                ?>
            </span>
        </h4>
</div>


<div class="row">
    <?php if (!empty($savedItems)) : ?>
        <?php foreach ($savedItems['cart_items'] as $item) : ?>
        <div class="col-sm-3 bg-dark p-2">
            <div class="bg-light" style="width:30% height:500px; border-radius: 21px 21px 0 0">
                <h6 class="ml-3 p-2 item-type"><?= $item['type']; ?></h6>
                <div class="row p-2">
                    <img src="#" class="img-thumbnail ml-3 p-2">
                    <div class="col-sm-12 d-flex">
                        <ul class="list-group">
                            <li class="item-type" hidden>type:<?= $item['type']; ?></li>
                            <li class="list-group-item item-price">Price: <?= $item['price']; ?></li>
                            <li class="list-group-item item-colour">Colour: <?= ucfirst($item['colour']); ?></li>
                            <li class="list-group-item item-material">Material: <?= ucfirst($item['material']); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else : ?>
        <?php foreach($shoppingList->getShoppingItems() as $item) : ?>
            <?= $shoppingList->render->renderItem($item); ?>
        <?php endforeach; ?>
    <?php endif; ?>

</div>

<div class="row mt-3">
    <div class="col">
        <!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_popup -->
<!--        <form method="post" action="/shopping-cart/register-cookie">-->
            <ul class="list-inline">
                <li>
                    <button class="btn btn-info save-shopping-cart" <?= !empty($savedItems) ? "data-toggle='modal' data-target='#myModal' onclick='getCookie()'" : ''?>>
                            <svg class="ml-2" id="svg-circle" hidden width="22" height="22" viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg" stroke="#fff">
                                <g fill="none" fill-rule="evenodd">
                                    <g transform="translate(1 1)" stroke-width="2">
                                        <circle stroke-opacity=".5" cx="18" cy="18" r="18"/>
                                        <path d="M36 18c0-9.94-8.06-18-18-18">
                                            <animateTransform
                                                    attributeName="transform"
                                                    type="rotate"
                                                    from="0 18 18"
                                                    to="360 18 18"
                                                    dur="1s"
                                                    repeatCount="indefinite"/>
                                        </path>
                                    </g>
                                </g>
                            </svg>
                        <?php if (!isset($_COOKIE['shopping_list'])) : ?>
                            <span class="save-shopping-cart-text">Save Shopping</span>
                        <?php else : ?>
                            <span class="save-shopping-cart-text">See Saved Shopping</span>
                        <?php endif; ?>


                    </button>
                    <?php
                        require_once(__DIR__ .  '/../components/models/success-message.php');
                    ?>
                </li>
            </ul>
    </div>
</div>

    <div class="modal" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Shopping Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col order-md-last">
                            <ul class="list-group mb-3 saved-shopping-cart">

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


