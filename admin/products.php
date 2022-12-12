<?php
require_once "../DB/dbcon.php";

require_once "../controller/ProductsController.php";
require_once "../controller/BrandController.php";
require_once "../controller/CategoryController.php";

require "../includes/layout/backHeader.php";
?>

<div class="container">
    <ul class="nav-tabs">
        <li class="active-tab" data-link="page-1">All Products</li>
        <li data-link="page-2">New Product</li>
    </ul>
    <div class="content active" id="page-1">
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
</div>

<?php require "../includes/layout/backFooter.php"; ?>