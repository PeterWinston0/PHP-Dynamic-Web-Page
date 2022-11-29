<?php 
require_once "../DB/dbcon.php";
require "../includes/layout/adminHeader.php";

$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM order_details, orders, product WHERE order_id = orders.orders_id AND product_id = product.id");
//$query = $dbCon->prepare("SELECT * FROM order_details");
$query->execute();
$getOrders = $query->fetchAll();
?>

<div class="row">
        <div class="row">
            <table class="highlight">
                <thead>
                <tr>
                    <th>orderDetails</th>
                    <th>Customer first name</th>
                    <th>product_name</th>
                    <th>price</th>
                </tr>
                </thead>

                <tbody>
                <?php
                foreach ($getOrders as $getOrders) {

                    echo "<tr>";

                    echo "<td>" . $getOrders['orders_id'] . "</td>";
                    echo "<td>" . $getOrders['first_name'] . "</td>";
                    echo "<td>" . $getOrders['product_name'] . "</td>";
                    echo "<td>" . $getOrders['product_price'] . "</td>";
                }
                ?>
                </tbody>
            </table>
        </div>

<?php require "../includes/layout/adminFooter.php"; ?>