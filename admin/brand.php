<?php
require_once "../db/dbcon.php";
require_once "../controller/BrandController.php";
require_once "../includes/layout/backHeader.php";
?>

<body>
    <div class="container">
        <div class="column">
            <h3>Add New Brand</h3>
            <form class="" name="brand" method="post" enctype="multipart/form-data" action="../crud/brand/addBrand.php">
                <div class="column">
                    <div class="input-field">
                        <label class="w-100 p-1" for="title">Title</label>
                        <input id="title" placeholder="Title" name="title" type="text" class="validate w-75 p-2"
                            required="" aria-required="true">
                    </div>
                </div>
                <div class="input-field">
                    <label class="w-100 p-1" for="title">Image</label>
                    <input type='file' name='file' />
                </div>
                <br />
                <button class="btn btn-dark" type="submit" name="submit">Add Brand
                </button>
            </form>
        </div>
        <hr>
        <div class="column">
            <h2>All Brands</h2>
            <div class="column">
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>title</th>
                            <th>image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $brands = new BrandController;
                    $result = $brands->all();
                    if ($result) {
                        foreach ($result as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . "<img src='../crud/brand/img/" . $row['image'] . "' width='100px' alt='images'>" . "</td>";
                            echo "<td>";
                            echo "</td>";
                            echo '<td><a href="editBrand.php?id=' . $row['brand_id'] . '" class="waves-effect waves-light btn" ">Edit</a></td>';
                            echo '<td><a href="../crud/brand/deleteBrand.php?id=' . $row['brand_id'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';
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