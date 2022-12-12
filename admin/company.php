<?php
require_once "../DB/dbcon.php";
require "../includes/layout/backHeader.php";
?>

<?php

$dbCon = dbCon($user, $pass);

$query = $dbCon->prepare("SELECT * FROM carousel ORDER BY id ASC");
$query->execute();
$getSlides = $query->fetchAll();

if (isset($_GET['com_id'])) {

    $comID = $_GET['com_id'];

    $sql = "SELECT * FROM company WHERE id = :com_id";
    $query = $dbCon->prepare($sql);
    $query->bindParam(':com_id', $comID, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
?>

<head>
    <style>
        .content {
            width: 90%;
            display: none;
        }

        .active {
            display: block;
        }

        .nav-tabs {
            list-style-type: none;
            padding: 5px;
        }

        .nav-tabs li {
            display: inline;
            padding: 5px 10px;
            background: lightgrey;
            cursor: pointer;
        }

        li.active-tab {
            background: lightblue;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>

<div class="container">

    <ul class="nav-tabs">
        <li class="active-tab" data-link="page-1">Info</li>
        <li data-link="page-2">Slides</li>
        <li data-link="page-3">Hours</li>
        <li data-link="page-4">Fourth Page</li>
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
                    <th>slideID</th>
                    <th>image</th>
                    <th>title</th>
                    <th>Position</th>
                    <th>Edit</th>

                </tr>
            </thead>

            <tbody>
                <?php
    foreach ($getSlides as $slides) {
        echo "<tr>";
        echo "<td>" . $slides['id'] . "</td>";
        echo "<td>" . "<img src='../crud/company/img/" . $slides['image'] . "' width='120' height='120' alt='images'>" . "</td>";
        echo "<td>" . $slides['text'] . "</td>";
        echo "<td>" . $slides['no_order'] . "</td>";

        echo '<td><a href="editSlides.php?car_id=' . $slides['id'] . '" class="waves-effect waves-light btn" ">Edit</a></td>';
        //echo '<td><a href="../crud/products/deleteProduct.php?id=' . $slides['id'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';
        echo "</tr>";
    }
                    ?>
            </tbody>
        </table>
    </div>
    <div class="content" id="page-3">
        This is going to be the content for the third page. This block isn't even visible until jQuery and user action
        makes it so. </div>
    <div class="content" id="page-4">
        This is going to be the content for the fourth page. This block isn't even visible until jQuery and user action
        makes it so. </div>

</div>

<script>
    // page is ready to go via HTML, jquery only comes into play when user interacts. 
    $(".nav-tabs li").click(function () {
        // only executes if tab/page not active
        if (!$(this).hasClass('active-tab')) {
            $(".nav-tabs li").removeClass("active-tab");
            $(this).addClass('active-tab');
            var page = "#" + $(this).attr("data-link");
            $(".content").removeClass('active');
            $(page).addClass('active');
        }
    });
</script>

<?php } else {
    header("Location: company.php?status=0");
} ?>

<?php require "../includes/layout/backFooter.php"; ?>