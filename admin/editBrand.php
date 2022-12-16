<?php 
require_once "../includes/config.php";

//SAVE EDIT DATA
if (isset($_POST['brand_id']) && isset($_POST['submit'])) {

    $dbCon = dbCon($user, $pass);

    $brandID = $_POST['brand_id'];
    $title = $_POST['title'];
    $brand_image = $_FILES["imagename"]["name"];

    if ($_FILES['imagename']['name'] == '') {
        //No file selected

        $sql = "UPDATE brand SET `title` = :title WHERE brandID = :brand_id";
        $query = $dbCon->prepare($sql);
        $query->bindParam(':brand_id', $brandID, PDO::PARAM_STR);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->execute();

        header("Location: brand.php?status=updated&id=$brandID");

    } else {
        move_uploaded_file($_FILES["imagename"]["tmp_name"], "../assets/img/" . $_FILES["imagename"]["name"]);

        $sql = "UPDATE brand SET `title` = :brand_title, `image` = :brand_image WHERE brandID = :brand_id";
        $query = $dbCon->prepare($sql);
        $query->bindParam(':brand_id', $brandID, PDO::PARAM_STR);
        $query->bindParam(':brand_title', $title, PDO::PARAM_STR);
        $query->bindParam(':brand_image', $brand_image, PDO::PARAM_STR);
        $query->execute();

        header("Location: brand.php?status=updated&id=$brandID");
    
    }
    //header("Location: ../../admin/category.php?status=updated&id=$catID");

} else {
    
    //header("Location: brand.php?status=0");
}

$imgid = intval($_GET['id']);
//LOAD EDIT DATA
if (isset($_GET['id'])) {

    $brandID = $_GET['id'];
    $dbCon = dbCon($user, $pass);
    $sql = "SELECT * FROM brand WHERE brandID = :brand_id";
    $query = $dbCon->prepare($sql);
    $query->bindParam(':brand_id', $imgid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    require "../includes/layout/backHeader.php";
?>

<div class="container">
    <?php
    foreach ($results as $result) {
    ?>
    <h3>Editing Brand "
        <?php echo $result->title; ?>"
    </h3>
    <form class="col s12" name="myBrand" enctype="multipart/form-data" method="post" action="update.php">
        <div class="row">
            <div class="input-field col s12">
                <input id="title" name="title" type="text" value="<?php echo $result->title; ?>" class="validate"
                    required="" aria-required="true">
                <label for="title">title</label>
            </div>
        </div>

        <div class="form-group ml-4">
            <label for="focusedinput" class="control-label">Current Image</label>
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

        <input type="hidden" name="brand_id" value="<?php echo $brandID; ?>">
        <button class="btn waves-effect waves-light" type="submit" name="submit">Update
        </button>
    </form>
</div>

<?php } else {
    header("Location: brand.php?status=0");
} ?>

<?php require "../includes/layout/backFooter.php"; ?>