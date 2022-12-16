<?php 
require_once "../includes/config.php";

//SAVE EDIT DATA
if (isset($_POST['brand_id']) && isset($_POST['submit'])) {

    $dbCon = dbCon($user, $pass);

    $brandID = $_POST['brand_id'];
    $title = $_POST['title'];
    $brand_image = $_FILES["imagename"]["name"];

    if ($_FILES['imagename']['name'] == '') {
        //No file selected

        $sql = "UPDATE brand SET `title` = :title WHERE brandID = :brand_id";
        $query = $dbCon->prepare($sql);
        $query->bindParam(':brand_id', $brandID, PDO::PARAM_STR);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->execute();

        header("Location: brand.php?status=updated&id=$brandID");

    } else {
        move_uploaded_file($_FILES["imagename"]["tmp_name"], "../assets/img/" . $_FILES["imagename"]["name"]);

        $sql = "UPDATE brand SET `title` = :brand_title, `image` = :brand_image WHERE brandID = :brand_id";
        $query = $dbCon->prepare($sql);
        $query->bindParam(':brand_id', $brandID, PDO::PARAM_STR);
        $query->bindParam(':brand_title', $title, PDO::PARAM_STR);
        $query->bindParam(':brand_image', $brand_image, PDO::PARAM_STR);
        $query->execute();

        header("Location: brand.php?status=updated&id=$brandID");
    
    }
    //header("Location: ../../admin/category.php?status=updated&id=$catID");

} else {
    
    //header("Location: brand.php?status=0");
}

?>