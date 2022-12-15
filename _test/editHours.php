<!-- <?php require_once "../../DB/dbcon.php";
//if (isset($_GET['id'])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Company</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<?php
//$companyID = $_GET['id'];
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM store_hours");
// $query = $dbCon->prepare("SELECT * FROM company WHERE id=$companyID");
$query->execute();
$getCompany = $query->fetchAll();
?>

<body>

    <div class="container">
        <h3>Editing Company Info"<?php echo $getCompany[0][1]; ?>"</h3>
        <form class="col s12" name="myProduct" method="post" action="updateCompany.php">
            <div class="row">
                <div class="input-field col s6">
                    <input id="description" name="description" type="text" value="<?php echo $getCompany[0][1]; ?>"
                        class="validate" required="" aria-required="true">
                    <label for="description">description</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" name="email" type="text" value="<?php echo $getCompany[0][2]; ?>"
                        class="validate" required="" aria-required="true">
                    <label for="email">email</label>
                </div>
                <div class="input-field col s6">
                    <input id="phone" name="phone" type="text" value="<?php echo $getCompany[0][3]; ?>"
                        class="validate" required="" aria-required="true">
                    <label for="phone">phone</label>
                </div>
            </div>
            <!-- <input type="hidden" name="id" value="<?php //echo $companyID; ?>"> -->
            <button class="btn waves-effect waves-light" type="submit" name="submit">Update
            </button>
        </form>
    </div>
    </div>
</body>

</html>
<?php //}else{header("Location: ../../admin/Company.php?status=0");}?> -->