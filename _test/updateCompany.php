<?php require_once "../../db/dbCon.php";
if (isset($_POST['com_id']) && isset($_POST['submit'])) {

    $dbCon = dbCon($user, $pass);

    $comID = $_POST['com_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $com_image = $_FILES["imagename"]["name"];

    var_dump($com_image);

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

        header("Location: ../../admin/company.php?status=updated");

    } else {

        move_uploaded_file($_FILES["imagename"]["tmp_name"], "../../crud/company/img/" . $_FILES["imagename"]["name"]);

        $sql = "UPDATE company SET `title` = :com_title, `description` = :com_description, `email` = :com_email, `phone` = :com_phone, `image` = :com_image WHERE id = :com_id";
        $query = $dbCon->prepare($sql);
        $query->bindParam(':com_id', $comID, PDO::PARAM_STR);
        $query->bindParam(':com_title', $title, PDO::PARAM_STR);
        $query->bindParam(':com_description', $description, PDO::PARAM_STR);
        $query->bindParam(':com_email', $email, PDO::PARAM_STR);
        $query->bindParam(':com_phone', $phone, PDO::PARAM_STR);
        $query->bindParam(':com_image', $com_image, PDO::PARAM_STR);
        $query->execute();

        header("Location: ../../admin/company.php?com_id=1&?status=updated");
    }

} else {
    echo "There is an error";
    header("Location: ../../admin/company.php../../admin/company.php?com_id=1&?status=updated?status=0");
}