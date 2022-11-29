<?php require_once "../DB/dbcon.php";
if (isset($_GET['id'])) {

    $productID = $_GET['id'];
    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("SELECT * FROM product WHERE id = $productID");
    $query->execute();
    $getProducts = $query->fetchAll();

    $queryCat = $dbCon->prepare("SELECT * FROM category");
    $queryCat->execute();
    $getCat = $queryCat->fetchAll();

    $queryBrand = $dbCon->prepare("SELECT * FROM brand");
    $queryBrand->execute();
    $getBrand = $queryBrand->fetchAll();

    $query = $dbCon->prepare("SELECT * FROM product_categories WHERE fk_product = $productID");
    $query->execute();
    $getProductsCat = $query->fetchAll(PDO::FETCH_ASSOC);

    $query = $dbCon->prepare("SELECT * FROM product_brands WHERE fk_product = $productID");
    $query->execute();
    $getProductsBrand = $query->fetchAll(PDO::FETCH_ASSOC);

    require "../includes/layout/backHeader.php";
?>

<div class="container">
    <div class="column">
        <div class="column">
            <h3>Editing product
                <?php echo $getProducts[0][1]; ?>
            </h3>
            <form class="" name="myProduct" method="post" action="../crud/products/updateProduct.php">
                <div class="input-field">
                    <label class="w-100 p-1" for="title">Title</label>
                    <input id="title" name="title" type="text" value="<?php echo $getProducts[0][1]; ?>"
                        class="validate w-75 p-2" required="" aria-required="true">
                </div>

                <div class="input-field">
                    <label class="w-100 p-1" for="description">Description</label>
                    <input id="description" name="description" type="text" value="<?php echo $getProducts[0][2]; ?>"
                        class="validate w-75 p-2" required="" aria-required="true">
                </div>
                <div class="input-field">
                    <label class="w-100 p-1" for="Price">price</label>
                    <input id="price" name="price" type="text" value="<?php echo $getProducts[0][3]; ?>"
                        class="validate w-75 p-2" required="" aria-required="true">
                </div>

                <div class="input-field">
                    <label class="w-100 p-1" for="">Categories</label>
                    <?php foreach ($getCat as $getCat) {
        echo "<input type='checkbox' id='category' name='category'";
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
        echo "<input type='checkbox' id='brand' name='brand'";
        if (array_search($getBrand['brand_id'], array_column($getProductsBrand, 'fk_brand')) !== false) {
            echo " checked ";
        }
        echo "  value='" . $getBrand['brand_id'] . "'>";
        echo "<label for='" . $getBrand['title'] . "'>" . $getBrand['title'] . "</label>";
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