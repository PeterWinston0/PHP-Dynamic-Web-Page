<?php
require_once "../db/dbcon.php";
require_once "../controller/ProductsController.php";
require_once "../controller/BrandController.php";
require_once "../controller/CategoryController.php";
require_once "../includes/layout/backHeader.php";

set_error_handler(function (int $errno, string $errstr) {
    if ((strpos($errstr, 'Undefined array key') === false) && (strpos($errstr, 'Undefined variable') === false)) {
        return false;
    } else {
        return true;
    }
}, E_WARNING);

$upSucces = '';

$titleErr = '';
$descErr = '';
$priceErr = '';
$imageErr = '';

$brand = '';
$cat = '';
$prod = '';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $brand = $_POST['brand'];
    $cat = $_POST['category'];
    $prod = $_POST['product'];

    function numbers_only($price)
    {
        return preg_match('/^([0-9]*)$/', $price);
    }

    //Title   
    $title = trim($_POST['title']);
    if (empty($title)) {
        $titleErr = "Please enter product title";
    } else if (!preg_match('/^[a-zA-Z0-9\s]+$/', $title)) {
        $titleErr = "Title can only contain letters, numbers and white spaces";
    } else {

        //Description
        $description = trim($_POST['description']);
        if (empty($description)) {
            $descErr = "Please enter product description";
        } else if (!preg_match('/^[a-zA-Z0-9\s]+$/', $description)) {
            $descErr = "Description can only contain letters, numbers and white spaces";
        } else {
            
            //Price
            $price = trim($_POST['price']);
            if (empty($price)) {
                $priceErr = "Please enter product price";
            } else if (!numbers_only($price)) {
                $priceErr = "Price can only contain numbers";
            } else {
                //Image // NEEDS EXTRA WORK
                if ($_FILES["file"]["error"] > 0) {
                    $imageErr = "Please upload an image";
                } else {
                    $file = $_FILES["file"]['tmp_name'];
                    list($width, $height) = getimagesize($file);
                    if (
                        (($_FILES['file']['type'] == "image/gif") ||
                            ($_FILES['file']['type'] == "image/jpeg") ||
                            ($_FILES['file']['type'] == "image/png") ||
                            ($_FILES['file']['type'] == "image/webp") ||
                            ($_FILES['file']['type'] == "image/pjpeg")) &&
                        ($_FILES['file']['size'] < 10000000)
                    ) {

                        if ($_FILES['file']['error'] > 0) {
                            echo "error code: " . $_FILES['file']['error'];
                        } else {
                            if (file_exists("../crud/products/img/" . $_FILES['file']['name'])) {
                                echo "You already have that file!";
                            } else if ($width > "2000" || $height > "1200") {
                                $imageErr = "Error : image size must smaller than 2000 x 1200 pixels.";
                            } else {
                                move_uploaded_file($_FILES['file']['tmp_name'], "../crud/products/img/" . $_FILES['file']['name']);
                                $myFile = $_FILES['file']['name'];
                                $dbCon = dbCon($user, $pass);
                                $query = $dbCon->prepare("INSERT INTO product(`title`, `description`, `price`, `image`) VALUES ('$title', '$description', '$price','$myFile')");
                                $query->execute();

                                $prod_id = $dbCon->lastInsertId();

                                $catArray = $_POST['category'];
                                if (is_array($catArray) || is_object($catArray)) {
                                    foreach ($catArray as $category) {
                                        $sql28 = "INSERT INTO product_categories(`fk_product`, `fk_category`) VALUES ('$prod_id', '$category')";
                                        $queryCat = $dbCon->prepare($sql28);
                                        $queryCat->execute();
                                    }
                                }
                                $brandArray = $_POST['brand'];
                                if (is_array($brandArray) || is_object($brandArray)) {
                                    foreach ($brandArray as $brand) {
                                        $sql30 = "INSERT INTO product_brands(`fk_product`, `fk_brand`) VALUES ('$prod_id', '$brand')";
                                        $queryBrand = $dbCon->prepare($sql30);
                                        $queryBrand->execute();
                                    }
                                }
                                $productArray = $_POST['product'];
                                if (is_array($productArray) || is_object($productArray)) {
                                    foreach ($productArray as $product) {
                                        $sql32 = "INSERT INTO product_related(`product_id`, `fk_product`) VALUES ('$prod_id', '$product')";
                                        $queryProd = $dbCon->prepare($sql32);
                                        $queryProd->execute();
                                    }
                                }
                                $upSucces = 'status added';
                            }
                        }
                    } else {
                        echo "invalid file!";
                    }
                }
            }
        }
    }
}
?>

<div class="container">
    <ul class="nav-tabs">
        <li class="active-tab" data-link="page-1">New Product</li>
        <li data-link="page-2">All Products</li>
        <?php echo $upSucces ?>
    </ul>
    <div class="content active" id="page-1">
        <!-- NEW PRODUCT -->
        <div class="column">
            <h2>Add New Product</h2>
            <form class="" name="product" method="post" enctype="multipart/form-data">
                <div class="column">
                    <div class="input-field">
                        <label for="title">
                            <?php echo $titleErr ?>
                        </label>
                        <label class="w-100 p-1" for="title">Title</label>
                        <input id="title" placeholder="Title" name="title" type="text" class="validate w-75 p-2"
                            aria-required="true">
                    </div>
                    <div class="input-field">
                        <label for="title">
                            <?php echo $descErr ?>
                        </label>
                        <label class="w-100 p-1" for="description">Description</label>
                        <input id="description" placeholder="Description" name="description" type="text"
                            class="validate w-75 p-2" aria-required="true">
                    </div>
                    <div class="input-field">
                        <label for="title">
                            <?php echo $priceErr ?>
                        </label>
                        <label class="w-100 p-1" for="price">Price</label>
                        <input id="price" placeholder="Price" name="price" type="text"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                            class="validate w-75 p-2" aria-required="true">
                    </div>
                    <div class="input-field">
                        <label for="title">
                            <?php echo $imageErr ?>
                        </label>
                        <label class="w-100 p-1" for="file">Image</label>
                        <input type='file' name='file' />
                    </div>

                    <!-- RELATED CATEGORY -->
                    <div class="input-field">
                        <label class="w-100 p-1" for="">Category</label>
                        <?php
                            $category = new CategoryController;
                            $result = $category->all();
                            if ($result) {
                                foreach ($result as $row) {
                                    echo "<input class='' type='checkbox' id='" . $row['title'] . "' name='category[]' value='" . $row['cat_id'] . "'>";
                                    echo "<label class='p-1' for='" . $row['title'] . "'>" . $row['title'] . "</label>";
                                }
                            }
                            ?>
                    </div>
                    <!-- RELATED BRANDS -->
                    <div class="input-field">
                        <label class="w-100 p-1" for="">Brand</label>
                        <?php
                            $brands = new BrandController;
                            $result = $brands->all();
                            if ($result) {
                                foreach ($result as $row) {
                                    echo "<input type='checkbox' id='" . $row['title'] . "' name='brand[]' value='" . $row['brand_id'] . "'>";
                                    echo "<label class='p-1' for='" . $row['title'] . "'>" . $row['title'] . "</label>";
                                }
                            }
                            ?>
                    </div>
                    <!-- RELATED PRODUCT -->
                    <div class="input-field">
                        <label class="w-100 p-1" for="">Related Products</label>
                        <?php
                            $products = new ProductsController;
                            $result = $products->all();
                            if ($result) {
                                foreach ($result as $row) {
                                    echo "<input type='checkbox' id='" . $row['title'] . "' name='product[]' value='" . $row['id'] . "'>";
                                    echo "<img src='../crud/products/img/" . $row['image'] . "' width='120' height='120' alt='images'>";
                                    echo "<label class='p-1' for='" . $row['title'] . "'>" . $row['title'] . "</label>";
                                }
                            }
                            ?>
                    </div>
                </div>
                <button class="btn btn-dark" type="submit" name="submit">Add Product
                </button>
            </form>
        </div>
    </div>

    <div class="content" id="page-2">
        <div class="column">
            <!-- ALL PRODUCTS -->
            <h2>All Products</h2>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>title</th>
                        <th>description</th>
                        <th>price</th>
                        <th>image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $products = new ProductsController;
                        $result = $products->all();
                        if ($result) {
                            foreach ($result as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['title'] . "</td>";
                                echo "<td>" . $row['description'] . "</td>";
                                echo "<td>" . $row['price'] . "</td>";
                                echo "<td>" . "<img src='../crud/products/img/" . $row['image'] . "' width='120' height='120' alt='images'>" . "</td>";
                                echo "<td>";

                                echo "</td>";
                                echo '<td><a href="editProduct.php?id=' . $row['id'] . '" class="waves-effect waves-light btn" ">Edit</a></td>';
                                echo '<td><a href="../crud/products/deleteProduct.php?id=' . $row['id'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';
                                echo "</tr>";
                            }
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require "../includes/layout/backFooter.php"; ?>