<?php require_once "../../DB/dbcon.php";

if (isset($_GET['id'])) {
    $categoryID = $_GET['id'];
    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("DELETE FROM category WHERE id=$categoryID");
    $query->execute();

    header("Location: ../../admin/category.php?status=deleted&id=$categoryID");
}else{
    header("Location: ../../admin/category.php?status=0");
}