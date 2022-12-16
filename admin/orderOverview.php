<?php
require_once "../includes/config.php";
require_once "../controller/CompanyController.php";
require "../includes/layout/backHeader.php";
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
                $orders = new CompanyController;
                $result = $orders->orders();
                if ($result) {
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['o_id'] . "</td>";
                        echo "<td>" . $row['first_name'] . "</td>";
                        echo "<td>" . $row['last_name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['created_at'] . "</td>";
                        echo "</td>";
                        echo '<td><a href="orderSingle.php?id=' . $row['o_id'] . '" class="waves-effect waves-light btn" ">Watch</a></td>';
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>


<?php require "../includes/layout/backFooter.php"; ?>