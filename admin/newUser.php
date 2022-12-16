<?php
require_once "../controller/CompanyController.php";
spl_autoload_register(
    function ($class) {
        include "../classes/" . $class . ".php";
    }
);
// START FORM PROCESSING
if (isset($_POST['submit'])) { // Form has been submitted.
    $newUser = new NewUser($_POST['user'], $_POST['pass']);
    $msg = $newUser->message;
}

require "../includes/layout/backHeader.php";
?>

<?php
if (!empty($msg)) {
    echo "<p>" . $msg . "</p>";
}
?>
<div class="column">
    <h2>Create New User</h2>
    <form action="" method="post">
        <div class="column">
            <div class="input-field">
                <label class="w-100 p-1" for="title">Username</label>
                <input type="text" class="validate w-75 p-2" name="user" maxlength="30" />
            </div>
            <div class="input-field">
                <label class="w-100 p-1" for="title">Password:</label>
                <input type="password" class="validate w-75 p-2" name="pass" maxlength="30" />
            </div>
        </div>
        <br/>
        <button class="btn btn-dark" type="submit" name="submit">Create User</button>
    </form>
</div>
<hr>

<div class="row" style="margin-left: 50px;">
    <div class="row">
        <table class="highlight">
            <thead>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Username</th>
                    <!-- <th>Password</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                $orders = new CompanyController;
                $result = $orders->allUsers();
                if ($result) {
                    foreach ($result as $row) {
                        echo "<tr>";
                        // echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['user'] . "</td>";
                        //echo "<td>" . $row['pass'] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

<?php require "../includes/layout/backFooter.php"; ?>