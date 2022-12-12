<?php require_once "../db/dbcon.php";

$imgid = intval($_GET['id']);

if (isset($_GET['id'])) {

    $productID = $_GET['id'];

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("SELECT * FROM product WHERE id = $productID");
    $query->execute();
    $getProd = $query->fetchAll();

    $queryCat = $dbCon->prepare("SELECT * FROM category");
    $queryCat->execute();
    $getCat = $queryCat->fetchAll();

    $queryBrand = $dbCon->prepare("SELECT * FROM brand");
    $queryBrand->execute();
    $getBrand = $queryBrand->fetchAll();

    $query = $dbCon->prepare("SELECT * FROM product ORDER BY id DESC");
    $query->execute();
    $getProducts = $query->fetchAll();

    $query = $dbCon->prepare("SELECT * FROM product_categories WHERE fk_product = $productID");
    $query->execute();
    $getProductsCat = $query->fetchAll(PDO::FETCH_ASSOC);

    $query = $dbCon->prepare("SELECT * FROM product_brands WHERE fk_product = $productID");
    $query->execute();
    $getProductsBrand = $query->fetchAll(PDO::FETCH_ASSOC);

    $query = $dbCon->prepare("SELECT * FROM product_related WHERE product_id = $productID");
    $query->execute();
    $getProductsRelated = $query->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM product WHERE id = :product_id";
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
            <form class="" name="myProduct" method="post" enctype="multipart/form-data" action="../crud/products/updateProduct.php">
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
                        <img src="../crud/products/img/<?php echo $result->image; ?>" width="200">
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
                <div class="input-field">
                    <label class="w-100 p-1" for="">Categories</label>
                    <?php foreach ($getCat as $getCat) {
                        echo "<input type='checkbox' id='" . $getCat['title'] . "' name='category[]'";
                        if (array_search($getCat['cat_id'], array_column($getProductsCat, 'fk_category')) !== false) {
                            echo " checked ";
                        }
                        echo "  value='" . $getCat['cat_id'] . "'>";
                        echo "<label for='" . $getCat['title'] . "'>" . $getCat['title'] . "</label>";
                    }
                    ?>
                </div>
                <div class="input-field">
                    <label class="w-100 p-1" for="">Brands</label>
                    <?php foreach ($getBrand as $getBrand) {
                        echo "<input type='checkbox' id='brand' name='brand[]'";
                        if (array_search($getBrand['brand_id'], array_column($getProductsBrand, 'fk_brand')) !== false) {
                            echo " checked ";
                        }
                        echo "  value='" . $getBrand['brand_id'] . "'>";
                        echo "<label for='" . $getBrand['title'] . "'>" . $getBrand['title'] . "</label>";
                    }
                    ?>
                </div>
                <!--RELATED PRODUCTS -->
                <div class="input-field">
                    <label class="w-100 p-1" for="">Related Products</label>
                    <?php foreach ($getProducts as $getProducts) {
                        echo "<input type='checkbox' id='product' name='product[]'";
                        if (array_search($getProducts['id'], array_column($getProductsRelated, 'fk_product')) !== false) {
                            echo " checked ";
                        }
                        echo "  value='" . $getProducts['id'] . "'>";
                        echo "<img src='../crud/products/img/" . $getProducts['image'] . "' width='120' height='120' alt='images'>";
                        echo "<label for='" . $getProducts['title'] . "'>" . $getProducts['title'] . "</label>";
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