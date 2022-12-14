<?php require_once "../../DB/dbcon.php";
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $brand = $_POST['brand'];
    $cat = $_POST['category'];
    $prod = $_POST['product'];

    if ((($_FILES['file']['type'] == "image/gif") ||
    ($_FILES['file']['type'] == "image/jpeg") ||
    ($_FILES['file']['type'] == "image/png") ||
    ($_FILES['file']['type'] == "image/webp") ||
    ($_FILES['file']['type'] == "image/pjpeg")) &&
    ($_FILES['file']['size'] < 10000000)) {
        if ($_FILES['file']['error'] > 0) {
            echo "error code: " . $_FILES['file']['error'];
        } else {
            echo "Uploaded: " . $_FILES['file']['name'] . "<br>";
            echo "Type: " . $_FILES['file']['type'] . "<br>";
            echo "Size: " . $_FILES['file']['size'] . "<br>";
            echo "Temp file: " . $_FILES['file']['tmp_name'] . "<br>";

            if (file_exists("img/" . $_FILES['file']['name'])) {
                echo "no dude, you already have tha file!";
            } else {
                move_uploaded_file($_FILES['file']['tmp_name'], "img/" . $_FILES['file']['name']);
                $myFile = $_FILES['file']['name'];
                $dbCon = dbCon($user, $pass);
                $query = $dbCon->prepare("INSERT INTO product(`title`, `description`, `price`, `image`) VALUES ('$title', '$description', '$price','$myFile')");
                $query->execute();

                $prod_id = $dbCon->lastInsertId();
                // var_dump($prod_id);

                $catArray = $_POST['category'];
                // var_dump($catArray);
                foreach ($catArray as $category) {
                    $sql28 = "INSERT INTO product_categories(`fk_product`, `fk_category`) VALUES ('$prod_id', '$category')";
                    echo $sql28;
                    $queryCat = $dbCon->prepare($sql28);
                    $queryCat->execute();
                }
                // var_dump($catArray);

                $brandArray = $_POST['brand'];
                // var_dump($catArray);
                foreach ($brandArray as $brand) {
                    $sql30 = "INSERT INTO product_brands(`fk_product`, `fk_brand`) VALUES ('$prod_id', '$brand')";
                    echo $sql30;
                    $queryBrand = $dbCon->prepare($sql30);
                    $queryBrand->execute();
                }
                // var_dump($catArray);

                $productArray = $_POST['product'];
                // var_dump($catArray);
                foreach ($productArray as $product) {
                    $sql32 = "INSERT INTO product_related(`product_id`, `fk_product`) VALUES ('$prod_id', '$product')";
                    echo $sql32;
                    $queryProd = $dbCon->prepare($sql32);
                    $queryProd->execute();
                }
                // var_dump($catArray);


                header("Location: ../../admin/products.php?status=added");
            }
        }
    } else {
        echo "invalid file!";
    }
} else {
    header("Location: ../../admin/products.php?status=0");
}