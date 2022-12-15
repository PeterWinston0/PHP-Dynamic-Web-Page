<?php
session_start();
$title = "Cart Page";

require_once('../includes/config.php');
require_once('../includes/helpers.php');

require_once "../controller/ProductsController.php";
//pre($_SESSION);

if (isset($_GET['action'], $_GET['item']) && $_GET['action'] == 'remove') {
    unset($_SESSION['cart_items'][$_GET['item']]);
    header('location:cart.php');
    exit();
}

// $qtyError = '';
// // Validation for qty before submit
// if (isset($_POST['submit-checkout'])) {
//     if ($_POST['cart-qty'] == '') {
//         $qtyError = "Please stop making being silly";
//     } else {
//         header('location:checkout.php');
//         exit();
//     }
// }

require "../includes/layout/frontHeader.php";

?>
<div class="page-container">
    <div class="">
        <?php if (empty($_SESSION['cart_items'])) { ?>
        <div class="cart-empty">
            <i class="fa fa-shopping-cart"></i>
            <h2>Your Shopping cart is still empty</h2>
            <p>Before proceed to checkout you must add some products to your shopping cart <br> You will find a lot of
                interisting products on our home page</p>
            <a href="index.php">
                <div class="cart-empty-btn">Return to shop</div>
            </a>
        </div>

        <?php } ?>
        <?php if (isset($_SESSION['cart_items']) && count($_SESSION['cart_items']) > 0) { ?>
        <div class="shoppingcart-wrap">
            <div class="cart-wrap">
                <h1 class="my-title">Shopping Cart</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $totalCounter = 0;
                            $itemCounter = 0;
                            foreach ($_SESSION['cart_items'] as $key => $item) {

                                $imgUrl = PRODUCT_IMG_URL . $item['product_img'];

                                $total = $item['product_price'] * $item['qty'];
                                $totalCounter += $total;
                                $itemCounter += $item['qty'];
                        ?>
                        <tr>
                            <td>
                                <img src="<?php echo $imgUrl; ?>" class="rounded img-thumbnail mr-2"
                                    style="width:60px;">
                                <?php echo $item['product_name']; ?>

                                <a href="cart.php?action=remove&item=<?php echo $key ?>" class="text-danger">
                                    <i class="fas fa-trash" style="font-size: 12px; color: red; padding-left: 5px;"></i>
                                </a>

                            </td>
                            <td>
                                DKK
                                <?php echo $item['product_price']; ?>
                            </td>

                            <td>
                                <!-- <p>
                                    <?php echo $qtyError ?>
                                </p> -->
                                <input type="number" name="cart-qty" class="cart-qty-single"
                                    data-item-id="<?php echo $key ?>" value="<?php echo $item['qty']; ?>" min="1"
                                    max="5" oninput="validity.valid||(value='');">
                            </td>
                            <td>
                                <?php echo $total; ?>
                            </td>
                        </tr>
                        <?php }

                        ?>
                        <tr class="cart-info">
                            <td><button class="clear-btn" id="emptyCart">Clear Cart</button></td>
                            <td></td>
                            <td></td>
                            <td>
                                <strong>
                                    <?php
                                        echo ($itemCounter == 1) ? $itemCounter . ' item' : $itemCounter . ' items'; 
                                    ?>
                                </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="summary-wrap">
                <td><strong><span>Subtotal</span> DKK
                        <?php echo $totalCounter; ?> ,-
                    </strong></td> <br>
                <td><strong><span>Shipping</span> DKK 35 ,-</strong></td>
                <div class="row">
                    <a href="checkout">
                        <button type="submit" name="submit-checkout" class="checkout-btn">Checkout</button>
                    </a>
                </div>
            </div>
        </div>

        <?php } ?>
    </div>
</div>

<div class="page-container">
    <h2 class="custom-title">People also looked at these products</h2>
    <div class="carousel">
        <div class="">
            <button type="button" class="slick-prev">Previous</button>
            <div class="product-carousel car1">
                <?php
                $products = new ProductsController;
                $result = $products->index();
                if ($result) {
                    foreach ($result as $row) {
                ?>
                <a class="myLink" href="single-product.php?product=<?php echo $row['id'] ?>">
                    <div class="carousel-item">
                        <img src="../assets/img/<?= $row['image'] ?>" style="width: 100%"></img>
                        <p>
                            <?= $row['title'] ?>
                        </p>
                        <p>DKK <?= $row['price'] ?>
                        </p>
                    </div>
                </a>
                <?php
                    }
                }
                ?>
                <button type="button" class="slick-next">Next</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $(".car1").slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 3,
        appendArrows: $(".car1"),
        dots: false,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 3,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });
});
</script>

<?php require "../includes/layout/frontFooter.php"; ?>