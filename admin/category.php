<?php
require_once "../db/dbcon.php";
require "../includes/layout/backHeader.php";
require_once "../controller/CategoryController.php";

$titleErr = '';

if (isset($_POST['submit'])) {

    $title = $_POST['title'];

    //Title   
    $title = trim($_POST['title']);
    if (empty($title)) {
        $titleErr = "Please enter product title";
    } else if (!preg_match('/^[a-zA-Z0-9\s]+$/', $title)) {
        $titleErr = "Title can only contain letters, numbers and white spaces";
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
                    ($_FILES['file']['type'] == "image/pjpeg")) &&
                ($_FILES['file']['size'] < 10000000)
            ) {
                if ($_FILES['file']['error'] > 0) {
                    echo "error code: " . $_FILES['file']['error'];
                } else {
                    if (file_exists("../crud/category/img/" . $_FILES['file']['name'])) {
                        echo "no dude, you already have tha file!";
                    } else if ($width > "2000" || $height > "1200") {
                        $imageErr = "Error : image size must smaller than 2000 x 1200 pixels.";
                    } else {
                        move_uploaded_file($_FILES['file']['tmp_name'], "../crud/category/img/" . $_FILES['file']['name']);
                        $myFile = $_FILES['file']['name'];
                        $dbCon = dbCon($user, $pass);
                        $query = $dbCon->prepare("INSERT INTO category(`title`, `image`) VALUES ('$title', '$myFile')");
                        $query->execute();
                        $upSucces = 'status added';
                    }
                }
            } else {
                echo "invalid file!";
            }
        }
    }
}
?>

<div class="container">
    <div class="column">
        <h3>Add New Category</h3>
        <form name="category" method="post" enctype="multipart/form-data">
            <div>
                <div class="input-field col s12">
                    <label for="title">
                        <?php echo $titleErr ?>
                    </label>
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