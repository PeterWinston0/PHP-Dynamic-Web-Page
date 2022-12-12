<?php
require_once "../DB/dbcon.php";
require_once "../controller/CompanyController.php";
require "../includes/layout/backHeader.php";

$dbCon = dbCon($user, $pass);

if (isset($_GET['com_id'])) {

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
                <form class="" name="myProduct" enctype="multipart/form-data" method="post"
                    action="../crud/company/updateCompany.php">
                    <div class="column">
                        <div class="input-field">
                            <label class="w-100 p-1" for="title">Title</label>
                            <input id="title" name="title" type="text" value="<?php echo $result->title; ?>"
                                class="validate w-75 p-2" required="" aria-required="true">
                        </div>
                        <div class="input-field">
                            <label class="w-100 p-1" for="description">Description</label>
                            <!-- <input id="description" name="description" type="text" value="<?php echo $result->description; ?>"
                            class="validate w-75 p-2" required="" aria-required="true"> -->
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
        This is going to be the content for the third page. This block isn't even visible until jQuery and user action
        makes it so. </div>
</div>

<?php } else {
    header("Location: company.php?status=0");
} ?>

<?php require "../includes/layout/backFooter.php"; ?>