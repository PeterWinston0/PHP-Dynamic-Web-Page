<?php 
session_start();
$title = "Products Page";
require_once('../includes/config.php');    
require_once('../includes/helpers.php');

$prodID = (int) $_GET['product'];
 
if(isset($_GET['product']) && !empty($_GET['product']) && is_numeric($_GET['product']))
    {
        $sql = "SELECT * FROM product WHERE product.id =:productID";
        $handle = $db->prepare($sql);
        $params = [
                ':productID' =>$_GET['product'],
            ];
        $handle->execute($params);
        if($handle->rowCount() == 1 )
        {
            $getProductData = $handle->fetch(PDO::FETCH_ASSOC);
             $imgUrl = PRODUCT_IMG_URL.$getProductData ['image'];
        }
        else
        {
            $error = '404! No record found';
        }
    }
    else
    {
        $error = '404! No record found';
    }

    if(isset($_POST['add_to_cart']) && $_POST['add_to_cart'] == 'add to cart')
    {
        $productID = intval($_POST['product_id']);
        $productQty = intval($_POST['product_qty']);

        $sql = "SELECT * FROM product WHERE product.id =:productID";

        $prepare = $db->prepare($sql);
        
        $params = [
                ':productID' =>$productID,
            ];
        
        $prepare->execute($params);
        $fetchProduct = $prepare->fetch(PDO::FETCH_ASSOC);

        $calculateTotalPrice = number_format($productQty * $fetchProduct['price'],2);
        
        $cartArray = [
            'product_id' =>$productID,
            'qty' => $productQty,
            'product_name' =>$fetchProduct['title'],
            'product_price' => $fetchProduct['price'],
            'total_price' => $calculateTotalPrice,
            'product_img' =>$fetchProduct['image']
        ];
        
        if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
        {
            $productIDs = [];
            foreach($_SESSION['cart_items'] as $cartKey => $cartItem)
            {
                $productIDs[] = $cartItem['product_id'];
                if($cartItem['product_id'] == $productID)
                {
                    $_SESSION['cart_items'][$cartKey]['qty'] = $productQty;
                    $_SESSION['cart_items'][$cartKey]['total_price'] = $calculateTotalPrice;
                    break;
                }
            }

            if(!in_array($productID,$productIDs))
            {
                $_SESSION['cart_items'][]= $cartArray;
            }

            $successMsg = true;
            
        }
        else
        {
            $_SESSION['cart_items'][]= $cartArray;
            $successMsg = true;
        }

    }

    //$dbCon = dbCon($user, $pass);
    $query = $db->prepare("SELECT * FROM product, product_related WHERE fk_product = product.id AND product_id = $prodID");
    $query->execute();
    $getRelatedProducts = $query->fetchAll();

    require "../includes/layout/frontHeader.php";

?>
<div class="page-container" style="background-color: white;">
    <?php if(isset($getProductData) && is_array($getProductData)){?>
        <?php if(isset($successMsg) && $successMsg == true){?>
            <div class="">
                <div class="">
                    <div class="alert alert-success alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert">&times;</button>
                         <img src="<?php echo $imgUrl ?>" class="rounded img-thumbnail mr-2" style="width:40px;"><?php echo $getProductData['title']?> is added to cart. <a href="cart.php" class="alert-link">View Cart</a>
                    </div>
                </div>
            </div>
         <?php }?>

        <div class="single-product">
            <div class="image">
                <img src="<?php echo $imgUrl;?>">
            </div>
            <div class="info">
                <h1><?php echo $getProductData['title']?></h1>
                <p><?php echo $getProductData['description']?></p>
                <h4>DKK <?php echo $getProductData['price']?></h4>
                
                <form class="form-inline" method="POST">
                    <div class="form-group mb-2">
                        <input type="number" name="product_qty" id="productQty" class="form-control" placeholder="Quantity" min="1" max="1000" value="1">
                        <input type="hidden" name="product_id" value="<?php echo $getProductData['id']?>">
                    </div>
                    <div class="form-group mb-2 ml-2">
                        <button type="submit" class="add-btn" name="add_to_cart" value="add to cart">Add to Cart</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <h3>Product Description:</h3>
                <?php echo $getProductData['description']?>
            </div>
        </div>

    <?php
    }
    ?>
<h2>This might also interest you</h2>
    <div class="related-product" style="">
        <?php
        foreach ($getRelatedProducts as $relatedProduct) {
        ?>
        <div class="product">
            <a class="myLink" href="single-product.php?product=<?php echo $relatedProduct['id'] ?>">
                <img class="" src="../crud/products/img/<?= $relatedProduct['image'] ?>" alt="Card image cap">
                <div class="body">
                    <h5 class="title">
                        <?= $relatedProduct['title'] ?>
                    </h5>
                    <p class="text">
                        DKK <?= $relatedProduct['price'] ?>,-
                    </p>
                    <!-- <p class="text">
                        <?= $relatedProduct['description'] ?>
                    </p> -->
                </div>
            </a>
        </div>
        <?php
        }
        ?>
    </div>
</div>
<?php require "../includes/layout/frontFooter.php";?>