<?php require_once "../../DB/dbcon.php";

if (isset($_GET['id'])) {
    $newsID = $_GET['id'];
    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("DELETE FROM news WHERE id=$newsID");
    $query->execute();

    header("Location: ../../admin/news.php?status=deleted&id=$newsID");
}else{
    header("Location: ../../admin/news.php?status=0");
}