<?php require_once "../db/dbCon.php";

$imgid = intval($_GET['car_id']);

if (isset($_GET['car_id'])) {

    $carID = $_GET['car_id'];
    $dbCon = dbCon($user, $pass);
    $sql = "SELECT * FROM carousel WHERE id = :car_id";
    $query = $dbCon->prepare($sql);
    $query->bindParam(':car_id', $imgid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    require "../includes/layout/backHeader.php";
?>

<div class="container">
    <?php
    foreach ($results as $result) {
    ?>
    <h3>Editing Slides "
        <!-- <?php echo $result->title; ?>" -->
    </h3>
    <form class="col s12" name="mySlides" enctype="multipart/form-data" method="post"
        action="../crud/company/updateSlides.php">
        <div class="row">
            <div class="input-field col s12">
                <input id="text" name="text" type="text" value="<?php echo $result->text; ?>" class="validate"
                     aria-required="true">
                <label for="text">title</label>
            </div>
            <div class="input-field col s12">
                <input id="no_order" name="no_order" type="text" value="<?php echo $result->no_order; ?>" class="validate"
                     aria-required="true">
                <label for="no_order">no_order</label>
            </div>
        </div>

        <div class="form-group ml-4">
            <label for="focusedinput" class=" control-label">Current Image </label>
            <div class="">
                <img src="../crud/company/img/<?php echo $result->image; ?>" width="200">
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

        <input type="hidden" name="car_id" value="<?php echo $carID; ?>">
        <button class="btn waves-effect waves-light" type="submit" name="submit">Update
        </button>
    </form>
</div>
</div>

<?php } else {
    header("Location: company.php?status=0");
} ?>

<?php require "../includes/layout/backFooter.php"; ?>