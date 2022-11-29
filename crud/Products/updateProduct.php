<?php require_once "../../DB/dbCon.php";
if (isset($_POST['id']) && isset($_POST['submit'])) {
    echo "sdklcs";
    //&& isset($_POST['cat_id'])
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $productID = $_POST['id'];
    // $catID = $_POST['cat_id'];

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("UPDATE product SET `title`='$title', `description`='$description', `price`='$price' WHERE id=$productID");
    $query->execute();

    // $queryCat = $dbCon->prepare("INSERT INTO product_categories (fk_product, fk_category) VALUES ('$_POST[id]','$_POST[cat_id]')");
    // $queryCat->execute();

    
     header("Location: ../../admin/products.php?status=updated&id=$productID");

}else{
     header("Location: ../../admin/products.php?status=0");
}