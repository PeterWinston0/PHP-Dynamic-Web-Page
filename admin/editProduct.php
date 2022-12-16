<?php 
require_once "../includes/config.php";
require_once "../controller/ProductsController.php";
require_once "../controller/BrandController.php";
require_once "../controller/CategoryController.php";


if (isset($_POST['id']) && isset($_POST['submit'])) {
    echo "sdklcs";
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $productID = $_POST['id'];
    $product_image = $_FILES["imagename"]["name"];

    $dbCon = dbCon($user, $pass);

    //UPDATE IMAGE
    move_uploaded_file($_FILES["imagename"]["tmp_name"], "../assets/img/" . $_FILES["imagename"]["name"]);
         
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
     foreach ($brandArray as $brand) {
          $sql30 = "INSERT INTO product_brands(`fk_product`, `fk_brand`) VALUES ('$productID', '$brand')";
          $queryBrand = $dbCon->prepare($sql30);
          $queryBrand->execute();
     }

     //DELETE PRODUCTS
    $query = $dbCon->prepare("DELETE FROM product_related WHERE product_id = $productID");
    $query->execute();

     //INSERT NEW PRODUCTS
     $productArray = $_POST['product'];
     foreach ($productArray as $product) {
          $sql32 = "INSERT INTO product_related(`product_id`, `fk_product`) VALUES ('$productID', '$product')";
          $queryProduct = $dbCon->prepare($sql32);
          $queryProduct->execute();
     }

    //header("Location: ../../admin/editProduct.php?status=updated&id=$productID");

} else {
    //header("Location: ../../admin/products.php?status=0");
}

//IMG ID
$imgid = intval($_GET['id']);

if (isset($_GET['id'])) {
    $productID = $_GET['id'];

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("SELECT * FROM product WHERE productID = $productID");
    $query->execute();
    $getProd = $query->fetchAll();

    $query = $dbCon->prepare("SELECT * FROM product_categories WHERE productID = $productID");
    $query->execute();
    $getProductsCat = $query->fetchAll(PDO::FETCH_ASSOC);

    $query = $dbCon->prepare("SELECT * FROM product_brands WHERE productID = $productID");
    $query->execute();
    $getProductsBrand = $query->fetchAll(PDO::FETCH_ASSOC);

    $query = $dbCon->prepare("SELECT * FROM product_related WHERE productID = $productID");
    $query->execute();
    $getProductsRelated = $query->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM product WHERE productID = :product_id";
    $query = $dbCon->prepare($sql);
    $query->bindParam(':product_id', $imgid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    require "../includes/layout/backHeader.php";
?>

<div class="container">
    <div class="column">
        <div class="column">

            <h3>Editing product
                <!-- <?php// echo $result->title; ?> -->
            </h3>
            <form class="" name="myProduct" method="post" enctype="multipart/form-data">
            <?php
            foreach ($results as $result) {
            ?>    
                <div class="input-field">
                    <label class="w-100 p-1" for="title">Title</label>
                    <input id="title" name="title" type="text" value="<?php echo $result->title; ?>"
                        class="validate w-75 p-2" required="" aria-required="true">
                </div>
                <div class="input-field">
                    <label class="w-100 p-1" for="description">Description</label>
                    <input id="description" name="description" type="text" value="<?php echo $result->description; ?>"
                        class="validate w-75 p-2" required="" aria-required="true">
                </div>
                <div class="input-field">
                    <label class="w-100 p-1" for="Price">price</label>
                    <input id="price" name="price" type="text" value="<?php echo $result->price; ?>"
                        class="validate w-75 p-2" required="" aria-required="true">
                </div>

                <div class="form-group ml-4">
                    <label for="focusedinput" class=" control-label">Current Image </label>
                    <div class="">
                        <img src="../assets/img/<?php echo $result->image; ?>" width="200">
                    </div>
                </div>

                <div class="form-group ml-4">
                    <label for="focusedinput" class=" control-label">New Image</label>

                    <div>
                        <input type="file" name="imagename" id="imagename">
                    </div>
                </div>
                <?php
                }
                ?>
                <!--CATEGORIES -->
                <div class="input-field">
                    <label class="w-100 p-1" for="">Categories</label>
                    <?php 
                        $category = new CategoryController;
                        $result = $category->all();
                        if ($result) {
                        foreach ($result as $row) {
                            echo "<input type='checkbox' id='" . $row['title'] . "' name='category[]'";
                            if (array_search($row['catID'], array_column($getProductsCat, 'catID')) !== false) {
                                echo " checked ";
                            }
                            echo "  value='" . $row['catID'] . "'>";
                            echo "<label for='" . $row['title'] . "'>" . $row['title'] . "</label>";
                        }
                    }
                    ?>
                </div>
                <!--BRANDS -->
                <div class="input-field">
                    <label class="w-100 p-1" for="">Brands</label>
                    <?php 
                        $brands = new BrandController;
                        $result = $brands->all();
                        if ($result) {
                        foreach ($result as $row) {
                            echo "<input type='checkbox' id='brand' name='brand[]'";
                            if (array_search($row['brandID'], array_column($getProductsBrand, 'brandID')) !== false) {
                                echo " checked ";
                            }
                            echo "  value='" . $row['brandID'] . "'>";
                            echo "<label for='" . $row['title'] . "'>" . $row['title'] . "</label>";
                        }
                    }
                    ?>
                </div>
                <!--RELATED PRODUCTS -->
                <div class="input-field">
                    <label class="w-100 p-1" for="">Related Products</label>
                    <?php 
                        $products = new ProductsController;
                        $result = $products->all();
                        if ($result) {
                        foreach ($result as $row) {
                            echo "<input type='checkbox' id='product' name='product[]'";
                            if (array_search($row['productID'], array_column($getProductsRelated, 'productID')) !== false) {
                                echo " checked ";
                            }
                            echo "  value='" . $row['productID'] . "'>";
                            echo "<img src='../assets/img/" . $row['image'] . "' width='120' height='120' alt='images'>";
                            echo "<label for='" . $row['title'] . "'>" . $row['title'] . "</label>";
                        }
                    }
                    ?>
                </div>
                <input type="hidden" name="id" value="<?php echo $productID; ?>">
                <button class="btn waves-effect waves-light" type="submit" name="submit">Update
                </button>
            </form>
        </div>
    </div>
</div>

<?php } else {
    header("Location: products.php?status=0");
} ?>

<?php require "../includes/layout/backFooter.php"; ?>