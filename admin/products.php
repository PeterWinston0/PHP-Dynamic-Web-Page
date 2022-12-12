<?php
require_once "../DB/dbcon.php";
require "../includes/layout/backHeader.php";
?>

<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM product ORDER BY id DESC");
$query->execute();
$getProducts = $query->fetchAll();

$queryCat = $dbCon->prepare("SELECT * FROM category");
$queryCat->execute();
$getCat = $queryCat->fetchAll();

$queryBrand = $dbCon->prepare("SELECT * FROM Brand");
$queryBrand->execute();
$getBrand = $queryBrand->fetchAll();
?>

<head>

    <style>
        .content {
            width: 90%;
            display: none;
        }

        .active {
            display: block;
        }

        .nav-tabs {
            list-style-type: none;
            padding: 5px;
        }

        .nav-tabs li {
            display: inline;
            padding: 5px 10px;
            background: lightgrey;
            cursor: pointer;
        }

        li.active-tab {
            background: lightblue;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>

<div class="container">
    <ul class="nav-tabs">
        <li class="active-tab" data-link="page-1">All Products</li>
        <li data-link="page-2">New Product</li>
        <!-- <li data-link="page-3">Third Page</li>
        <li data-link="page-4">Fourth Page</li> -->
    </ul>
    <div class="content active" id="page-1">
    <div class="column">
            <!-- ALL PRODUCTS -->
            <h2>All Products</h2>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>productID</th>
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
                     foreach ($getProducts as $products) {
                        echo "<tr>";
                        echo "<td>" . $products['id'] . "</td>";
                        echo "<td>" . $products['title'] . "</td>";
                        echo "<td>" . $products['description'] . "</td>";
                        echo "<td>" . $products['price'] . "</td>";
                        echo "<td>" . "<img src='../crud/products/img/" . $products['image'] . "' width='120' height='120' alt='images'>" . "</td>";
                        echo "<td>";

                        echo "</td>";
                        echo '<td><a href="editProduct.php?id=' . $products['id'] . '" class="waves-effect waves-light btn" ">Edit</a></td>';
                        echo '<td><a href="../crud/products/deleteProduct.php?id=' . $products['id'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';
                        echo "</tr>";
                     }
                    ?>
                </tbody>
            </table>

        </div>
    </div>

    <div class="content" id="page-2">
                <!-- NEW PRODUCT -->
                <div class="column">
            <h2>Add New Product</h2>
            <form class="" name="product" method="post" enctype="multipart/form-data"
                action="../crud/products/addProduct.php">
                <div class="column">
                    <div class="input-field">
                        <label class="w-100 p-1" for="title">Title</label>
                        <input id="title" placeholder="Title" name="title" type="text" class="validate w-75 p-2"
                            required="" aria-required="true">
                    </div>
                    <div class="input-field">
                        <label class="w-100 p-1" for="description">Description</label>
                        <input id="description" placeholder="Description" name="description" type="text"
                            class="validate w-75 p-2" required="" aria-required="true">
                    </div>
                    <div class="input-field">
                        <label class="w-100 p-1" for="price">Price</label>
                        <input id="price" placeholder="Price" name="price" type="text" class="validate w-75 p-2"
                            required="" aria-required="true">
                    </div>
                    <div class="input-field">
                        <label class="w-100 p-1" for="file">Image</label>
                        <input type='file' name='file' />
                    </div>

                    <!-- RELATED CATEGORY -->
                    <div class="input-field">
                        <label class="w-100 p-1" for="">Category</label>
                        <?php foreach ($getCat as $getCat) {
                            echo "<input class='' type='checkbox' id='" . $getCat['title'] . "' name='category[]' value='" . $getCat['cat_id'] . "'>";
                            echo "<label class='p-1' for='" . $getCat['title'] . "'>" . $getCat['title'] . "</label>";
                        }
                        ?>
                    </div>
                    <!-- RELATED BRANDS -->
                    <div class="input-field">
                        <label class="w-100 p-1" for="">Brand</label>
                        <?php foreach ($getBrand as $getBrand) {
                            echo "<input type='checkbox' id='" . $getBrand['title'] . "' name='brand[]' value='" . $getBrand['brand_id'] . "'>";
                            echo "<label class='p-1' for='" . $getBrand['title'] . "'>" . $getBrand['title'] . "</label>";
                        }
                        ?>
                    </div>
                    <!-- RELATED PRODUCT -->
                    <div class="input-field">
                        <label class="w-100 p-1" for="">Related Products</label>
                        <?php foreach ($getProducts as $product) {
                            echo "<input type='checkbox' id='" . $product['title'] . "' name='product[]' value='" . $product['id'] . "'>";
                            echo "<img src='../crud/products/img/" . $product['image'] . "' width='120' height='120' alt='images'>";
                            echo "<label class='p-1' for='" . $product['title'] . "'>" . $product['title'] . "</label>";
                        }
                        ?>
                    </div>
                </div>
                <button class="btn btn-dark" type="submit" name="submit">Add Product
                </button>
            </form>
        </div>
    </div>

    <!-- <div class="content" id="page-3">
        This is going to be the content for the fourth page. This block isn't even visible until jQuery and user
        action makes it so.
    </div>

    <div class="content" id="page-4">
        This is going to be the content for the fourth page. This block isn't even visible until jQuery and user
        action makes it so. </div> -->

</div>
<script>
    // page is ready to go via HTML, jquery only comes into play when user interacts. 
    $(".nav-tabs li").click(function () {
        // only executes if tab/page not active
        if (!$(this).hasClass('active-tab')) {
            $(".nav-tabs li").removeClass("active-tab");
            $(this).addClass('active-tab');
            var page = "#" + $(this).attr("data-link");
            $(".content").removeClass('active');
            $(page).addClass('active');
        }
    });
</script>

<?php require "../includes/layout/backFooter.php"; ?>