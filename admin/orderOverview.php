<?php
require_once "../DB/dbcon.php";
require "../includes/layout/backHeader.php";

$dbCon = dbCon($user, $pass);


//$query = $dbCon->prepare("SELECT * FROM order_details, orders, product WHERE order_id = o_id AND product_id = product.id");
$query = $dbCon->prepare("SELECT * FROM orders");
$query->execute();
$getOrders = $query->fetchAll();

//$idx = 0;
?>

<div class="row" style="margin-left: 50px;">
    <div class="row">
        <table class="highlight">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Date and Time</th>
                    <th>Watch</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($getOrders as $getOrders) {

                    echo "<tr>";

                    echo "<td>" . $getOrders['o_id'] . "</td>";
                    echo "<td>" . $getOrders['first_name'] . "</td>";
                    echo "<td>" . $getOrders['last_name'] . "</td>";
                    echo "<td>" . $getOrders['email'] . "</td>";
                    echo "<td>" . $getOrders['created_at'] . "</td>";

                    echo "</td>";
                    echo '<td><a href="orderSingle.php?id='.$getOrders['o_id'].'" class="waves-effect waves-light btn" ">Watch</a></td>';
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>






<?php require "../includes/layout/backFooter.php"; ?>