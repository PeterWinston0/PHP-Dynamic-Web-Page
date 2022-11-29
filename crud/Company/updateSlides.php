<?php require_once "../../db/dbCon.php";
if (isset($_POST['car_id']) && isset($_POST['submit'])) {

     $dbCon = dbCon($user, $pass);
     
     $carID = $_POST['car_id'];
     $text = $_POST['text'];
     $no_order = $_POST['no_order'];
     $car_image = $_FILES["imagename"]["name"];
     var_dump($car_image);
     var_dump($carID);
     var_dump($text);
     var_dump($no_order);

     if ($_FILES['imagename']['name'] == '') {
          //No file selected

          $sql = "UPDATE carousel SET `text` = :car_text, `no_order` = :car_order WHERE id = :car_id";
          $query = $dbCon->prepare($sql);
          $query->bindParam(':car_id', $carID, PDO::PARAM_STR);
          $query->bindParam(':car_text', $text, PDO::PARAM_STR);
          $query->bindParam(':car_order', $no_order, PDO::PARAM_STR);
          $query->execute();

          header("Location: ../../admin/company.php?status=updated&com_id=1");
          
     } else {

          move_uploaded_file($_FILES["imagename"]["tmp_name"], "../../crud/company/img/" . $_FILES["imagename"]["name"]);
          
          $sql = "UPDATE carousel SET `image` = :car_image, `text` = :car_text, `no_order` = :car_order WHERE id = :car_id";
          $query = $dbCon->prepare($sql);
          $query->bindParam(':car_id', $carID, PDO::PARAM_STR);
          $query->bindParam(':car_image', $car_image, PDO::PARAM_STR);
          $query->bindParam(':car_text', $text, PDO::PARAM_STR);
          $query->bindParam(':car_order', $no_order, PDO::PARAM_STR);
          
          $query->execute();

          header("Location: ../../admin/company.php?status=updated&com_id=1");
     }

     //header("Location: ../../admin/category.php?status=updated&id=$catID");

} else {
    header("Location: ../../admin/company.php?com_id=1&status=0");
}