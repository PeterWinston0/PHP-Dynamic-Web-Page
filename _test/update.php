<?php 
require_once "../db/dbcon.php";

if(isset($_POST['field']) && isset($_POST['value']) && isset($_POST['id'])){
    $dbCon = dbCon($user, $pass);

    $field = $_POST['field']; 
    $value = $_POST['value'];
    $editid = $_POST['id'];

    $sql = "UPDATE company_hours SET ".$field."='".$value."' WHERE id=".$editid;
    $query = $dbCon->prepare($sql);
    $query->execute();

    echo 1;
}else{
    echo 0;
}

exit;