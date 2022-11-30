<?php 
    session_start();


     if(!isset($_SESSION['confirm_order']) || empty($_SESSION['confirm_order']))
     {
         header('location:index.php');
         exit();
     }

     $cartItemCount = count($_SESSION['cart_items']);
        var_dump($cartItemCount);


     require "../includes/layout/frontHeader.php";
?>
<div class="page-container">
<div class="row">
    <div class="col-md-12">
        <h1>Thank you!</h1>
        <div class="summary-block">
            <h2>Order Summary</h2>
            <?php if(isset($_SESSION['cart_items']) && count($_SESSION['cart_items']) > 0){?>

            <?php 
                    $totalCounter = 0;
                    $itemCounter = 0;
                    foreach($_SESSION['cart_items'] as $key => $item){
                    
                      $imgUrl = PRODUCT_IMG_URL.$item['product_img'];

                    $total = $item['product_price'] * $item['qty'];
                    $totalCounter+= $total;
                    $itemCounter+=$item['qty'];
                    ?>


            <li class="order-summary">
                <div>
                    <img src="<?php echo $imgUrl; ?>" class="rounded img-thumbnail mr-2" style="">
                </div>
                <div>
                    <h6 class="my-0">
                        <?php echo $item['product_name'] ?>
                    </h6>
                    <small class="text-muted">Quantity:
                        <?php echo $item['qty'] ?> X Price:
                        <?php echo $item['product_price'] ?>
                    </small>
                    <br>
                    <span class="text-muted">$
                        <?php echo $total;?>
                        <!-- <?php echo $item['total_price'] ?> -->
                    </span>
                </div>

            </li>
            <?php }?>
            <div class="total-price">
                <strong>
                    <p>Total</p>
                    <p>DKK <?php echo $totalCounter;?> ,-</p>
                    <!-- <?php echo $item['total_price'] ?> -->
                </strong>
            </div>
            <?php }?>

        </div>
        <p>
            Your order has been placed.
            <?php unset($_SESSION['confirm_order']);?>
            <?php unset($_SESSION['cart_items']); ?>
        </p>
    </div>
</div>
</div>
<?php require ("../includes/layout/frontFooter.php")?>