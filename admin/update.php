<?php 

require_once "../db/config.php";

if(isset($_POST['field']) && isset($_POST['value']) && isset($_POST['id'])){
    $field = mysqli_real_escape_string($con,$_POST['field']); 
    $value = mysqli_real_escape_string($con,$_POST['value']); 
    $editid = mysqli_real_escape_string($con,$_POST['id']);
    
    $query = "UPDATE company_hours SET ".$field."='".$value."' WHERE id=".$editid;
    mysqli_query($con,$query);
    
    echo 1;
}else{
    echo 0;
}

exit;