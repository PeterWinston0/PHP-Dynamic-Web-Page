<?php require_once "../db/dbCon.php";

$imgid = intval($_GET['cat_id']);

if (isset($_GET['cat_id'])) {

    $catID = $_GET['cat_id'];
    $dbCon = dbCon($user, $pass);
    $sql = "SELECT * FROM category WHERE cat_id = :cat_id";
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
    <form class="col s12" name="myCategory" enctype="multipart/form-data" method="post"
        action="../crud/category/updateCategory.php">
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
                <img src="../crud/category/img/<?php echo $result->image; ?>" width="200">
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
</div>

<?php } else {
    header("Location: category.php?status=0");
} ?>

<?php require "../includes/layout/backFooter.php"; ?>