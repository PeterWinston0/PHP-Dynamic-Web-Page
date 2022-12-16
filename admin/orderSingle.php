<?php 

require_once('../includes/config.php');
require_once('../includes/helpers.php');


if (isset($_GET['id'])) {

    $order_id = $_GET['id'];
    $dbCon = dbCon($user, $pass);
    $sql = "SELECT * FROM orders WHERE o_id = :order_id";
    $query = $dbCon->prepare($sql);
    $query->bindParam(':order_id', $order_id, PDO::PARAM_STR);
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_OBJ);

    $query = $dbCon->prepare("SELECT * FROM order_details, orders, product WHERE order_id = o_id AND order_details.productID = product.productID AND o_id = $order_id");
    $query->execute();
    $resultProduct = $query->fetchAll();

    require "../includes/layout/backHeader.php";
?>

<div class="container">
    <?php
    foreach ($results as $result) {
    ?>
    <p>
        <?php echo $result->first_name; ?>
    </p>
    <p>
        <?php echo $result->last_name; ?>
    </p>
    <p>
        <?php echo $result->email; ?>
    </p>
    <p>
        <?php echo $result->created_at; ?>
    </p>
    <p></p>
    <?php
    }
    ?>

    <?php
    foreach ($resultProduct as $product) {
    ?>
    <p>
        <?= $product['title'] ?>
    </p>
    <img src="../assets/img/<?= $product['image'] ?>" width="200">
    <?php
    }
    ?>
</div>
    <?php } else {
    header("Location: orderOverview.php?status=0");
} ?>

    <?php require "../includes/layout/backFooter.php"; ?>