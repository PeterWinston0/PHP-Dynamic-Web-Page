<?php 
session_start();
$title = "Cart Page";

require_once "../controller/ProductsController.php";
//pre($_SESSION);

if(isset($_GET['action'],$_GET['item']) && $_GET['action'] == 'remove')
{
    unset($_SESSION['cart_items'][$_GET['item']]);
    header('location:cart.php');
    exit();
}

require "../includes/layout/frontHeader.php";
?>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>

</head>

<div class="page-container">
    <div class="page-title">
        <h2>Shopping Cart</h2>
    </div>
    <div class="row"></div>
    <div class="">
        <?php if(empty($_SESSION['cart_items'])){?>
        <div class="cart-empty">
            <i class="fa fa-shopping-cart"></i>
            <h2>Your Shopping cart is still empty</h2>
            <p>Before proceed to checkout you must add some products to your shopping cart <br> You will find a lot of
                interisting products on our home page</p>
            <input type="button" class="cart-empty-btn" value="Return to shop">
        </div>


        <?php }?>
        <?php if(isset($_SESSION['cart_items']) && count($_SESSION['cart_items']) > 0){?>
        <div class="shoppingcart-wrap">
            <div class="cart-wrap">
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
                    foreach($_SESSION['cart_items'] as $key => $item){

                      $imgUrl = PRODUCT_IMG_URL.$item['product_img'];   
                    
                    $total = $item['product_price'] * $item['qty'];
                    $totalCounter += $total;
                    $itemCounter += $item['qty'];

                
                    ?>
                        <tr>
                            <td>
                                <img src="<?php echo $imgUrl; ?>" class="rounded img-thumbnail mr-2"
                                    style="width:60px;"><?php echo $item['product_name'];?>

                                <a href="cart.php?action=remove&item=<?php echo $key?>" class="text-danger">
                                    <i class="fas fa-trash" style="font-size: 12px; color: red; padding-left: 5px;"></i>
                                </a>

                            </td>
                            <td>
                                DKK <?php echo $item['product_price'];?>
                            </td>
                            <td>
                                <input type="number" name="" class="cart-qty-single" data-item-id="<?php echo $key?>"
                                    value="<?php echo $item['qty'];?>" min="1" max="5">
                            </td>
                            <td>
                                <?php echo $total;?>
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
                                echo ($itemCounter==1)?$itemCounter.' item':$itemCounter.' items'; ?>
                                </strong>
                            </td>
                            <!-- <td><strong>DKK <?php echo $totalCounter;?> ,-</strong></td> -->
                        </tr>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="summary-wrap">
                <td><strong><span>Subtotal</span> DKK <?php echo $totalCounter;?> ,-</strong></td> <br>
                <td><strong><span>Shipping</span> DKK 35 ,-</strong></td>
                <div class="row">
                    <div class="">
                        <a href="checkout.php">
                            <button class="checkout-btn">Checkout</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>

<div class="block">
        <h2 class="myHead">People also looked at these products</h2>
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
                            <img src="../crud/products/img/<?= $row['image'] ?>" style="width: 100%"></img>
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

<?php require "../includes/layout/frontFooter.php";?>