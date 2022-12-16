<?php
session_start();
$title = "Thank You / Invoice";
require_once('../config.php');
require_once('../includes/helpers.php');

if (!isset($_SESSION['confirm_order']) || empty($_SESSION['confirm_order'])) {
    header('location:index.php');
    exit();
}
require "../includes/layout/frontHeader.php";
?>
<div class="page-container">
    <div class="thanks-wrap">
        <div class="thanks-head">
            <h1>Thank you!</h1>
            <p> Your order has been placed.</p>
            <h3>Ordernumber <br>
                <?php echo $_SESSION['order_number']; ?>
            </h3>
        </div>
        <div class="summary-thanks">
            <h2>Order Summary</h2>

            <?php if (isset($_SESSION['thanks_items']) && count($_SESSION['thanks_items']) > 0) { ?>

            <?php
                $totalCounter = 0;
                $itemCounter = 0;
                foreach ($_SESSION['thanks_items'] as $key => $item) {

                    $imgUrl = PRODUCT_IMG_URL . $item['product_img'];

                    $total = $item['product_price'] * $item['qty'];
                    $totalCounter += $total;
                    $itemCounter += $item['qty'];
            ?>

            <li class="order-summary">
                <div class="img-wrap">
                    <img src="<?php echo $imgUrl; ?>" class="" style="">
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
                    <span class="text-muted">
                        $
                        <?php echo $total; ?>
                    </span>
                </div>

            </li>
            <?php } ?>
            <div class="total-price">
                <strong>
                    <p>Total</p>
                    <p>DKK
                        <?php echo $totalCounter; ?> ,-
                    </p>
                </strong>
            </div>
            <?php } ?>
        </div>
        <?php unset($_SESSION['order_number']); ?>
        <?php unset($_SESSION['confirm_order']); ?>
        <?php unset($_SESSION['thanks_items']); ?>
    </div>
</div>
<?php require("../includes/layout/frontFooter.php") ?>