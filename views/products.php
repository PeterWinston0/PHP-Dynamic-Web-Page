<?php
session_start();
$title = "Products Page";
require "../includes/layout/frontHeader.php";
require_once("../db/dbcon.php");

$dbCon = dbCon($user, $pass);
if ($_GET['cat_id']) {
    $cat_id = (int) $_GET['cat_id'];

    $query = $dbCon->prepare("SELECT * FROM product, product_categories WHERE fk_product = product.id AND fk_category = $cat_id");
    $query->execute();
    $getAllProducts = $query->fetchAll();

    $query = $dbCon->prepare("SELECT * FROM category WHERE cat_id = $cat_id");
    $query->execute();
    $getAllCat = $query->fetchAll();

} else if ($_GET['brand_id']) {
    $brand_id = (int) $_GET['brand_id'];

    $query = $dbCon->prepare("SELECT * FROM product, product_brands WHERE fk_product = product.id AND fk_brand = $brand_id");
    $query->execute();
    $getAllProducts = $query->fetchAll();

    $query = $dbCon->prepare("SELECT * FROM brands WHERE brand_id = $brand_id");
    $query->execute();
    $getAllCat = $query->fetchAll();
}
?>
<div class="page-container">
    <?php
    foreach ($getAllCat as $cat) {
    ?>
        <h2 class="block-title">
            <?php echo $cat['title'] ?>
        </h2>
 
    <?php
    }
    ?>
    <div class="product-container" style="">
        <?php
        foreach ($getAllProducts as $product) {
        ?>
        <div class="product">
            <a class="myLink" href="single-product.php?product=<?php echo $product['id'] ?>">
                <img class="" src="../assets/img/<?= $product['image'] ?>" alt="Card image cap">
                <div class="body">
                    <h5 class="title">
                        <?= $product['title'] ?>
                    </h5>
                    <p class="text">
                        DKK <?= $product['price'] ?>,-
                    </p>
                    <!-- <p class="text">
                        <?= $product['description'] ?>
                    </p> -->
                </div>
            </a>
        </div>
        <?php
        }
        ?>
    </div>
</div>

<?php require "../includes/layout/frontFooter.php"; ?>