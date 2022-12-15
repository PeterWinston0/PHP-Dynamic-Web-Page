<?php
require_once "../db/dbcon.php";
require_once "../controller/CompanyController.php";
require "../includes/layout/backHeader.php";

$upSucces = '';

$titleErr = '';
$descErr = '';
$emailErr = '';
$phoneErr = '';
$imageErr = '';

if (isset($_POST['com_id']) && isset($_POST['submit'])) {

    $dbCon = dbCon($user, $pass);

    $comID = $_POST['com_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $com_image = $_FILES["imagename"]["name"];
    //var_dump($com_image);

    function numbers_only($price)
    {
        return preg_match('/^([0-9]*)$/', $price);
    }

    //Title  
    $title = trim($_POST['title']);
    if (empty($title)) {
        $titleErr = "Please enter product title";
    } else if (!preg_match('/^[a-zA-Z0-9\s]+$/', $title)) {
        $titleErr = "Title can only contain letters, numbers and white spaces";
    } else {

        //Description
        $description = trim($_POST['description']);
        if (empty($description)) {
            $descErr = "Please enter product description";
        }
        // else if (!preg_match('/^[a-zA-Z0-9\s]+$/', $description)) {
        //     $descErr = "Description can only contain letters, numbers and white spaces";
        // }
        else {

            //Email   
            $email = trim($_POST['email']);
            if (empty($email)) {
                $emailErr = "Please enter product title";
            }
            // else if (!preg_match('/^[a-zA-Z0-9\s]+$/', $email)) {
            //     $emailErr = "Title can only contain letters, numbers and white spaces";
            // } 
            else {

                //Phone
                $phone = trim($_POST['phone']);
                if (empty($phone)) {
                    $phoneErr = "Please enter Phone Number";
                }
                // else if (!numbers_only($phone)) {
                //     $phoneErr = "Phone Number can only contain numbers";
                // } 
                else {
                    if ($_FILES['imagename']['name'] == '') {

                        //No file selected
                        $sql = "UPDATE company SET `title` = :com_title, `description` = :com_description, `email` = :com_email, `phone` = :com_phone WHERE id = :com_id";
                        $query = $dbCon->prepare($sql);
                        $query->bindParam(':com_id', $comID, PDO::PARAM_STR);
                        $query->bindParam(':com_title', $title, PDO::PARAM_STR);
                        $query->bindParam(':com_description', $description, PDO::PARAM_STR);
                        $query->bindParam(':com_email', $email, PDO::PARAM_STR);
                        $query->bindParam(':com_phone', $phone, PDO::PARAM_STR);
                        $query->execute();

                        $upSucces = 'status added';
                    } else {
                        move_uploaded_file($_FILES["imagename"]["tmp_name"], "../crud/company/img/" . $_FILES["imagename"]["name"]);

                        $sql = "UPDATE company SET `title` = :com_title, `description` = :com_description, `email` = :com_email, `phone` = :com_phone, `image` = :com_image WHERE id = :com_id";
                        $query = $dbCon->prepare($sql);
                        $query->bindParam(':com_id', $comID, PDO::PARAM_STR);
                        $query->bindParam(':com_title', $title, PDO::PARAM_STR);
                        $query->bindParam(':com_description', $description, PDO::PARAM_STR);
                        $query->bindParam(':com_email', $email, PDO::PARAM_STR);
                        $query->bindParam(':com_phone', $phone, PDO::PARAM_STR);
                        $query->bindParam(':com_image', $com_image, PDO::PARAM_STR);
                        $query->execute();

                        $upSucces = 'status added';
                    }
                }
            }
        }
    }
}

if(isset($_POST['field']) && isset($_POST['value']) && isset($_POST['id'])){
    $dbCon = dbCon($user, $pass);

    $field = $_POST['field']; 
    $value = $_POST['value'];
    $editid = $_POST['id'];

    $sql = "UPDATE company_hours SET ".$field."='".$value."' WHERE id=".$editid;
    $query = $dbCon->prepare($sql);
    $query->execute();
}

if (isset($_GET['com_id'])) {
    $dbCon = dbCon($user, $pass);
    $comID = $_GET['com_id'];

    $sql = "SELECT * FROM company WHERE id = :com_id";
    $query = $dbCon->prepare($sql);
    $query->bindParam(':com_id', $comID, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container">
    <ul class="nav-tabs">
        <li class="active-tab" data-link="page-1">Info</li>
        <li data-link="page-2">Slides</li>
        <li data-link="page-3">Hours</li>
    </ul>
    <div class="content active" id="page-1">
        <?php
    foreach ($results as $result) {
        ?>
        <div class="column">
            <div class="column">
                <h3>Editing Company Info "
                    <?php echo $result->title; ?>"
                </h3>
                <form class="" name="myProduct" enctype="multipart/form-data" method="post">
                    <div class="column">
                        <div class="input-field">
                            <label class="w-100 p-1" for="title">Title</label>
                            <input id="title" name="title" type="text" value="<?php echo $result->title; ?>"
                                class="validate w-75 p-2" required="" aria-required="true">
                        </div>
                        <div class="input-field">
                            <label class="w-100 p-1" for="description">Description</label>
                            <textarea id="description" name="description" class="validate w-75 p-2"
                                aria-required="true"><?php echo $result->description; ?></textarea>

                        </div>
                        <div class="input-field">
                            <label class="w-100 p-1" for="email">Email</label>
                            <input id="email" name="email" type="text" value="<?php echo $result->email; ?>"
                                class="validate w-75 p-2" required="" aria-required="true">

                        </div>
                        <div class="input-field">
                            <label class="w-100 p-1" for="phone">Phone</label>
                            <input id="phone" name="phone" type="text" value="<?php echo $result->phone; ?>"
                                class="validate w-75 p-2" required="" aria-required="true">

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
                    <input type="hidden" name="com_id" value="<?php echo $comID; ?>">
                    <br>
                    <button class="btn btn-dark" type="submit" name="submit">Update Company Description
                    </button>
                </form>
            </div>
        </div>
        <?php
    }
        ?>
    </div>
    <div class="content" id="page-2">
        <h2>All Slides</h2>
        <table class="highlight">
            <thead>
                <tr>
                    <th>image</th>
                    <th>title</th>
                    <th>Position</th>
                    <th>Edit</th>
                </tr>
            </thead>

            <tbody>
                <?php
    $company = new CompanyController;
    $result = $company->Slides();
    if ($result) {
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . "<img src='../crud/company/img/" . $row['image'] . "' width='120' height='120' alt='images'>" . "</td>";
            echo "<td>" . $row['text'] . "</td>";
            echo "<td>" . $row['no_order'] . "</td>";

            echo '<td><a href="editSlides.php?car_id=' . $row['id'] . '" class="waves-effect waves-light btn" ">Edit</a></td>';
            echo "</tr>";
        }
    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="content" id="page-3">
        <div class='container'>

        <table width='100%' border='0'>
        <tr>
            <th width='10%'>S.no</th>
            <th width='40%'>day</th>
            <th width='40%'>time</th>
        </tr>
        <?php
            $dbCon = dbCon($user, $pass);
            $sql = "SELECT * FROM company_hours ORDER BY id";
            $query = $dbCon->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);

             $count = 1;

            foreach ($results as $result) {
            ?>
        <tr>
            <td>
                <?php echo $count; ?>
            </td>
            <td>
                <div contentEditable='true' class='edit' id='day_<?php echo $result->id; ?>'>
                    <?php echo $result->day; ?>
                </div>
            </td>
            <td>
                <div contentEditable='true' class='edit' id='time_<?php echo $result->id; ?>'>
                    <?php echo $result->time; ?>
                </div>
            </td>
        </tr>
        <?php
                $count++;
            }
            ?>
    </table>

        </div>
    </div>
</div>

<?php } else {
    header("Location: company.php?status=0");
} ?>

<script src='../assets/js/editHours.js' type='text/javascript'></script>

<!-- Script -->
<script type="text/javascript">
    CKEDITOR.replace('description', {
        height: "200px"
    }); 
</script>

<?php require "../includes/layout/backFooter.php"; ?>