<?php
require_once "../DB/dbcon.php";
require "../includes/layout/backHeader.php";
?>

<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM brand");
$query->execute();
$getBrand = $query->fetchAll();
//var_dump($getUsers);
?>

<body>
    <div class="container">
        <!-- <?php
              // if (isset($_GET['status'])) {
              //     if ($_GET['status'] == "deleted") {
              //         echo "The entry " . $_GET['id'] . " has been successfully deleted!";
              //         echo "<script>M.toast({html: 'Deleted!'})</script>";
              //     } elseif ($_GET['status'] == "updated") {
              //         echo "The entry " . $_GET['id'] . " has been successfully Updated!";
              //         echo "<script>M.toast({html: 'Updated!'})</script>";
              //     } elseif ($_GET['status'] == "added") {
              //         echo "The new entry has been successfully added!";
              //         echo "<script>M.toast({html: 'Added!'})</script>";
              //     }
              // }
              ?> -->
        <div class="column">
            <h3>Add New Brand</h3>
            <form class="" name="category" method="post" enctype="multipart/form-data"
                action="../crud/brand/addBrand.php">
                <div class="column">
                    <div class="input-field">
                        <label class="w-100 p-1" for="title">Title</label>
                        <input id="title" placeholder="Title" name="title" type="text" class="validate w-75 p-2" required=""
                            aria-required="true">
                    </div>
                </div>
                <div class="input-field">
                    <label class="w-100 p-1" for="title">Image</label>
                    <input type='file' name='file' />
                </div>
                <br/>
                <button class="btn btn-dark" type="submit" name="submit">Add Brand
                </button>
            </form>
        </div>
        <hr>
        <div class="column">
            <h2>All Brands</h2>
            <div class="column">
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>productID</th>
                            <th>title</th>
                            <th>image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($getBrand as $getBrand) {

                            echo "<tr>";

                            echo "<td>" . $getBrand['brand_id'] . "</td>";
                            echo "<td>" . $getBrand['title'] . "</td>";
                            echo "<td>" . "<img src='../crud/brand/img/" . $getBrand['image'] . "' width='100px' alt='images'>" . "</td>";

                            echo "<td>";

                            echo "</td>";
                            echo '<td><a href="../crud/news/editNews.php?id=' . $getBrand['brand_id'] . '" class="waves-effect waves-light btn" ">Edit</a></td>';
                            echo '<td><a href="../crud/news/deleteNews.php?id=' . $getBrand['brand_id'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require "../includes/layout/backFooter.php"; ?>