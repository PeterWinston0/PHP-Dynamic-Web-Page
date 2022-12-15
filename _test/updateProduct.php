<?php require_once "../../db/dbCon.php";
if (isset($_POST['id']) && isset($_POST['submit'])) {
     echo "sdklcs";
     //&& isset($_POST['cat_id'])
     $title = $_POST['title'];
     $description = $_POST['description'];
     $price = $_POST['price'];
     $productID = $_POST['id'];
     $product_image = $_FILES["imagename"]["name"];
     var_dump($product_image);


     $dbCon = dbCon($user, $pass);

     //UPDATE IMAGE
     move_uploaded_file($_FILES["imagename"]["tmp_name"], "../../crud/products/img/" . $_FILES["imagename"]["name"]);
          
     $sql = "UPDATE product SET `image` = :product_image WHERE id = :product_id";
     $query = $dbCon->prepare($sql);
     $query->bindParam(':product_id', $productID, PDO::PARAM_STR);
     $query->bindParam(':product_image', $product_image, PDO::PARAM_STR);
     $query->execute();

     //UPDATE NEW CONTENT
     $query = $dbCon->prepare("UPDATE product SET `title`='$title', `description`='$description', `price`='$price' WHERE id=$productID");
     $query->execute();

     //DELETE CATEGORIES
     $query = $dbCon->prepare("DELETE FROM product_categories WHERE fk_product = $productID");
     $query->execute();

     //INSERT NEW CATEGORIES
     $catArray = $_POST['category'];
     var_dump($catArray);
     foreach ($catArray as $category) {
          $sql28 = "INSERT INTO product_categories(`fk_product`, `fk_category`) VALUES ('$productID', '$category')";
          $queryCat = $dbCon->prepare($sql28);
          $queryCat->execute();
     }

     //DELETE BRANDS
     $query = $dbCon->prepare("DELETE FROM product_brands WHERE fk_product = $productID");
     $query->execute();

      //INSERT NEW BRANDS
      $brandArray = $_POST['brand'];
      var_dump($brandArray);
      foreach ($brandArray as $brand) {
           $sql30 = "INSERT INTO product_brands(`fk_product`, `fk_brand`) VALUES ('$productID', '$brand')";
           $queryBrand = $dbCon->prepare($sql30);
           $queryBrand->execute();
      }

      //DELETE BRANDS
     $query = $dbCon->prepare("DELETE FROM product_related WHERE product_id = $productID");
     $query->execute();

      //INSERT NEW PRODUCTS
      $productArray = $_POST['product'];
      var_dump($productArray);
      foreach ($productArray as $product) {
           $sql32 = "INSERT INTO product_related(`product_id`, `fk_product`) VALUES ('$productID', '$product')";
           $queryProduct = $dbCon->prepare($sql32);
           $queryProduct->execute();
      }

     header("Location: ../../admin/editProduct.php?status=updated&id=$productID");

} else {
     header("Location: ../../admin/products.php?status=0");
}