<?php

use ShoppingCart\Classes\ShoppingList;

$shoppingList = new ShoppingList();

?>
<div class="container">
<div class="row">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill ml-3 shopping-cart-count">0</span>
        </h4>
</div>


<div class="row">
    <?php foreach($shoppingList->getShoppingItems() as $item) : ?>
        <?= $shoppingList->render->renderItem($item); ?>
    <?php endforeach; ?>
</div>

<div class="row mt-3">
    <div class="col">
        <!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_popup -->
<!--        <form method="post" action="/shopping-cart/register-cookie">-->
            <ul class="list-inline">
                <li>
                    <button class="btn btn-info save-shopping-cart">
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
                        <span class="save-shopping-cart-text">Save Shopping</span>
                    </button>
                    <?php
                    require_once(__DIR__ .  '/../components/models/success-message.php');
                    ?>
                </li>
            </ul>
    </div>
</div>

</div>

