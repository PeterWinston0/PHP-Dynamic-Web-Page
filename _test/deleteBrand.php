<?php require_once "../../DB/dbcon.php";

if (isset($_GET['id'])) {
    $brandID = $_GET['id'];
    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("DELETE FROM brand WHERE brand_id = $brandID");
    $query->execute();

    header("Location: ../../admin/brand.php?status=deleted&id=$brandID");
}else{
    header("Location: ../../admin/brand.php?status=0");
}