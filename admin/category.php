<?php
session_start();
require_once "../db/dbCon.php";
require "../includes/layout/backHeader.php";
require_once "../controller/CategoryController.php";
?>

<body>

    <div class="container">
        <?php
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
        ?>
        <div class="column">
            <h3>Add new Category</h3>
            <form class="" name="category" method="post" enctype="multipart/form-data"
                action="../crud/category/addCategory.php">
                <div>
                    <div class="input-field col s12">
                        <input id="title" name="title" type="text" class="validate" required="" aria-required="true">
                        <label for="title">title</label>
                    </div>
                </div>
                <div class="input-field col s6">
                    <input type='file' name='file' />
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="submit">Add
                </button>
            </form>
        </div>
        <hr>
        <div class="column">
            <div class="column">
                <h2>All Categories</h2>
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
                    $category = new CategoryController;
                    $result = $category->all();
                    if ($result) {
                        foreach ($result as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . "<img src='../crud/category/img/" . $row['image'] . "' width='120' height='120' alt='images'>" . "</td>";
                            echo "<td>";
                            echo "</td>";
                            echo '<td><a href="editCategory.php?cat_id=' . $row['cat_id'] . '" class="waves-effect waves-light btn" ">Edit</a></td>';
                            echo '<td><a href="../crud/category/deleteCategory.php?id=' . $row['cat_id'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';
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