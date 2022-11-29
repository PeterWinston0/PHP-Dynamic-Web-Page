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

<body>
    <div class="container">
        <!-- <?php
        // if (isset($_GET['status'])) {
        //     if ($_GET['status'] == "deleted") {
        //         echo "The entry " . $_GET['id'] . " has been successfully deleted!";
        //         echo "<script>M.toast({html: 'Deleted!'})</script>";
        //     } elseif ($_GET['status'] == "updated") {
        //         echo "The entry " . $_GET['id'] . " has been successfully Updated!";
        //         echo "<script>M.toast({html: 'Updated!'})</script>";
        //     } elseif ($_GET['status'] == "added") {
        //         echo "The new entry has been successfully added!";
        //         echo "<script>M.toast({html: 'Added!'})</script>";
        //     }
        // }
        ?> -->
        <div class="column">
            <div class="column">
                <h2>Add New Product</h2>
                <form class="" name="product" method="post" enctype="multipart/form-data" action="../crud/products/addProduct.php">
                    <div class="column">
                        <div class="input-field">
                            <label class="w-100 p-1" for="title">Title</label>
                            <input id="title" placeholder="Title" name="title" type="text" class="validate w-75 p-2" required=""
                                aria-required="true">
                        </div>
                        <div class="input-field">
                            <label class="w-100 p-1" for="description">Description</label>
                            <input id="description" placeholder="Description" name="description" type="text" class="validate w-75 p-2" required=""
                                aria-required="true">
                        </div>
                        <div class="input-field">
                            <label class="w-100 p-1" for="price">Price</label>
                            <input id="price" placeholder="Price" name="price" type="text" class="validate w-75 p-2" required=""
                                aria-required="true">
                        </div>
                        <div class="input-field">
                            <label class="w-100 p-1" for="file">Image</label>
                            <input type='file' name='file' />
                        </div>
                        <div class="input-field">
                            <label class="w-100 p-1" for="">Category</label>
                            <?php foreach ($getCat as $getCat) {
                            echo "<input class='' type='checkbox' id='" . $getCat['title'] . "' name='category[]' value='" . $getCat['cat_id'] . "'>";
                            echo "<label class='p-1' for='" . $getCat['title'] . "'>" . $getCat['title'] . "</label>";
                        }
                        ?>
                        </div>
                        <div class="input-field">
                            <label class="w-100 p-1" for="">Brand</label>
                            <?php foreach ($getBrand as $getBrand) {
                            echo "<input type='checkbox' id='" . $getBrand['title'] . "' name='brand[]' value='" . $getBrand['brand_id'] . "'>";
                            echo "<label class='p-1' for='" . $getBrand['title'] . "'>" . $getBrand['title'] . "</label>";
                        }
                        ?>
                        </div>




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
            <hr>
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
                        foreach ($getProducts as $getProducts) {
                            echo "<tr>";
                            echo "<td>" . $getProducts['id'] . "</td>";
                            echo "<td>" . $getProducts['title'] . "</td>";
                            echo "<td>" . $getProducts['description'] . "</td>";
                            echo "<td>" . $getProducts['price'] . "</td>";
                            echo "<td>" . "<img src='../crud/products/img/" . $getProducts['image'] . "' width='120' height='120' alt='images'>" . "</td>";
                            echo "<td>";

                            echo "</td>";
                            echo '<td><a href="editProduct.php?id=' . $getProducts['id'] . '" class="waves-effect waves-light btn" ">Edit</a></td>';
                            echo '<td><a href="../crud/products/deleteProduct.php?id=' . $getProducts['id'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';
                            echo "</tr>";
                        }
                        ?>
                </tbody>
            </table>

        </div>
    </div>
    <?php require "../includes/layout/backFooter.php"; ?>