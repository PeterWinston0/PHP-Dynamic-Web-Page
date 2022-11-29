<?php
require_once "../DB/dbCon.php";
require "../includes/layout/backHeader.php";
?>

<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM company_hours");
$query->execute();
$getHours = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
    <div class="container">
        <div class="column">
            <div class="column">
                <h2>Update Opening Hours</h2>
                <form class="" name="product" method="post" action="addHours.php">
                    <div class="column">
                        <div class="input-field">
                            <label class="w-100 p-1" for="">Add Opening Hours</label>
                            <?php foreach ($getHours as $hours) {
                                echo "<label class='w-100 p-1' for='title'>" . $hours['day'] . "</label>";

                                echo "<input id='title' type='text' class='validate w-75 p-2' name='open[]' aria-required='true' value='" . $hours['open'] . "'>";

                                echo "<input id='title' type='text' class='validate w-75 p-2' name='close[]' aria-required='true' value='" . $hours['close'] . "'>";
                                echo "<input type='hidden' name='id' value='" . $hours['id'] . "'>";
                            }

                            ?>
                        </div>
                    </div>
                    <button class="btn btn-dark" type="submit" name="submit">Add Product
                    </button>
                </form>
            </div>
            <hr>

        </div>
    </div>
    <?php require "../includes/layout/backFooter.php"; ?>