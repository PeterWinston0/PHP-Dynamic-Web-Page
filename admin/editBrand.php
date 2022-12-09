<?php require_once "../db/dbCon.php";

$imgid = intval($_GET['id']);

if (isset($_GET['id'])) {

    $brandID = $_GET['id'];
    $dbCon = dbCon($user, $pass);
    $sql = "SELECT * FROM brand WHERE brand_id = :brand_id";
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
    <form class="col s12" name="myBrand" enctype="multipart/form-data" method="post"
        action="../crud/brand/updateBrand.php">
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
                <img src="../crud/brand/img/<?php echo $result->image; ?>" width="200">
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
</div>

<?php } else {
    header("Location: brand.php?status=0");
} ?>

<?php require "../includes/layout/backFooter.php"; ?>