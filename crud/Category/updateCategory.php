<?php require_once "../../db/dbcon.php";
if (isset($_POST['cat_id']) && isset($_POST['submit'])) {

     $dbCon = dbCon($user, $pass);
     
     $catID = $_POST['cat_id'];
     $title = $_POST['title'];
     $cat_image = $_FILES["imagename"]["name"];
     //var_dump($cat_image);

     if ($_FILES['imagename']['name'] == '') {
          //No file selected

          $sql = "UPDATE category SET `title` = :cat_title WHERE cat_id = :cat_id";
          $query = $dbCon->prepare($sql);
          $query->bindParam(':cat_id', $catID, PDO::PARAM_STR);
          $query->bindParam(':cat_title', $title, PDO::PARAM_STR);
          $query->execute();

          header("Location: ../../admin/category.php?status=updated&id=$catID");
          
     } else {

          move_uploaded_file($_FILES["imagename"]["tmp_name"], "../../crud/category/img/" . $_FILES["imagename"]["name"]);
          
          $sql = "UPDATE category SET `title` = :cat_title, `image` = :cat_image WHERE cat_id = :cat_id";
          $query = $dbCon->prepare($sql);
          $query->bindParam(':cat_id', $catID, PDO::PARAM_STR);
          $query->bindParam(':cat_title', $title, PDO::PARAM_STR);
          $query->bindParam(':cat_image', $cat_image, PDO::PARAM_STR);
          $query->execute();

          header("Location: ../../admin/category.php?status=updated&id=$catID");
     }

     //header("Location: ../../admin/category.php?status=updated&id=$catID");

} else {
     header("Location: ../../admin/category.php?status=0");
}