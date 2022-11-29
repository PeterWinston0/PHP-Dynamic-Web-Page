<?php 
session_start();
$title = "Cart Page";
require "../includes/layout/frontHeader.php";

if(isset($_GET['action'],$_GET['item']) && $_GET['action'] == 'remove')
{
    unset($_SESSION['cart_items'][$_GET['item']]);
    header('location:cart.php');
    exit();
}

?>
<div class="page-container">
    <div class="page-title">
        <h2>My Shopping Cart</h2>
    </div>
    <div class="row">
        <div class="">
            <?php if(empty($_SESSION['cart_items'])){?>
            <table class="table">
                <tr>
                    <td>
                        <p>Your Shopping cart is still empty</p>
                    </td>
                </tr>
            </table>
            <?php }?>
            <?php if(isset($_SESSION['cart_items']) && count($_SESSION['cart_items']) > 0){?>
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
                    $totalCounter+= $total;
                    $itemCounter+=$item['qty'];
                    ?>
                    <tr>
                        <td>
                            <img src="<?php echo $imgUrl; ?>" class="rounded img-thumbnail mr-2"
                                style="width:60px;"><?php echo $item['product_name'];?>

                            <a href="cart.php?action=remove&item=<?php echo $key?>" class="text-danger">
                                <i class="bi bi-trash-fill"></i>
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
                    <?php }?>
                    <tr class="border-top border-bottom">
                        <td><button class="clear-btn" id="emptyCart">Clear Cart</button></td>
                        <td></td>
                        <td>
                            <strong>
                                <?php 
                                echo ($itemCounter==1)?$itemCounter.' item':$itemCounter.' items'; ?>
                            </strong>
                        </td>
                        <td><strong>DKK <?php echo $totalCounter;?> ,-</strong></td>
                    </tr>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="">
                    <a href="checkout.php">
                        <button class="checkout-btn">Checkout</button>
                    </a>
                </div>
            </div>

            <?php }?>
        </div>
    </div>
</div>

    <?php require "../includes/layout/frontFooter.php";?>