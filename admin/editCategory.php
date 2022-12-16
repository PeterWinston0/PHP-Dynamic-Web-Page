<?php
require_once "../includes/config.php"; 

//SAVE EDIT DATA
if (isset($_POST['cat_id']) && isset($_POST['submit'])) {

    $dbCon = dbCon($user, $pass);
    
    $catID = $_POST['cat_id'];
    $title = $_POST['title'];
    $cat_image = $_FILES["imagename"]["name"];

    if ($_FILES['imagename']['name'] == '') {
         //No file selected
         $sql = "UPDATE category SET `title` = :cat_title WHERE catID = :cat_id";
         $query = $dbCon->prepare($sql);
         $query->bindParam(':cat_id', $catID, PDO::PARAM_STR);
         $query->bindParam(':cat_title', $title, PDO::PARAM_STR);
         $query->execute();

         header("Location: category.php?status=updated&id=$catID");
         
    } else {

         move_uploaded_file($_FILES["imagename"]["tmp_name"], "../assets/img/" . $_FILES["imagename"]["name"]);
         
         $sql = "UPDATE category SET `title` = :cat_title, `image` = :cat_image WHERE catID = :cat_id";
         $query = $dbCon->prepare($sql);
         $query->bindParam(':cat_id', $catID, PDO::PARAM_STR);
         $query->bindParam(':cat_title', $title, PDO::PARAM_STR);
         $query->bindParam(':cat_image', $cat_image, PDO::PARAM_STR);
         $query->execute();

         //header("Location: category.php?status=updated&id=$catID");
    }

    //header("Location: category.php?status=updated&id=$catID");

} else {
    //header("Location: ../..category.php?status=0");
}

$imgid = intval($_GET['id']);
//LOAD EDIT DATA
if (isset($_GET['id'])) {
    $catID = $_GET['id'];
    $dbCon = dbCon($user, $pass);
    $sql = "SELECT * FROM category WHERE catID = :cat_id";
    $query = $dbCon->prepare($sql);
    $query->bindParam(':cat_id', $imgid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    require "../includes/layout/backHeader.php";
?>

<div class="container">
    <?php
    foreach ($results as $result) {
    ?>
    <h3>Editing Category "
        <?php echo $result->title; ?>"
    </h3>
    <form class="col s12" name="myCategory" enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="input-field col s12">
                <input id="title" name="title" type="text" value="<?php echo $result->title; ?>" class="validate"
                    required="" aria-required="true">
                <label for="title">title</label>
            </div>
        </div>

        <div class="form-group ml-4">
            <label for="focusedinput" class=" control-label">Current Image </label>
            <div class="">
                <img src="../assets/img/<?php echo $result->image; ?>" width="200">
            </div>
        </div>

        <div class="form-group ml-4">
            <label for="focusedinput" class=" control-label">New Image</label>
            <div class="">
                <input type="file" name="imagename" id="imagename">
            </div>
        </div>
        <?php
    }
        ?>

        <input type="hidden" name="cat_id" value="<?php echo $catID; ?>">
        <button class="btn waves-effect waves-light" type="submit" name="submit">Update
        </button>
    </form>
</div>

<?php } else {
    //header("Location: category.php?status=0");
} ?>

<?php require "../includes/layout/backFooter.php"; ?>