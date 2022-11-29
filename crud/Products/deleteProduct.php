<?php require_once "../../DB/dbcon.php";

if (isset($_GET['id'])) {
    $productID = $_GET['id'];
    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("DELETE FROM product WHERE id=$productID");
    $query->execute();

    header("Location: ../../admin/products.php?status=deleted&id=$productID");
}else{
    header("Location: ../../admin/products.php?status=0");
}