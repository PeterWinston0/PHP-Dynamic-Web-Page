<?php require_once "../../db/dbcon.php";
if (isset($_POST['id']) && isset($_POST['submit'])) {
    $dbCon = dbCon($user, $pass);

    $newsID = $_POST['id'];

    $title = $_POST['title'];
    $content = $_POST['content'];
    $news_image = $_FILES["imagename"]["name"];
    
    if ($_FILES['imagename']['name'] == '') {
        //No file selected

        $sql = "UPDATE news SET `title` = :title, `content` = :content WHERE id = :news_id";
        $query = $dbCon->prepare($sql);
        $query->bindParam(':news_id', $newsID, PDO::PARAM_STR);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':content', $content, PDO::PARAM_STR);
        $query->execute();

        header("Location: ../../admin/brand.php?status=updated&id=$newsID");

    } else {

        move_uploaded_file($_FILES["imagename"]["tmp_name"], "../../img/" . $_FILES["imagename"]["name"]);

        $sql = "UPDATE news SET `title` = :title, `content` = :content, `image` = :news_image WHERE id = :news_id";
        $query = $dbCon->prepare($sql);
        $query->bindParam(':news_id', $newsID, PDO::PARAM_STR);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':content', $content, PDO::PARAM_STR);
        $query->bindParam(':news_image', $news_image, PDO::PARAM_STR);
        $query->execute();

        //header("Location: ../../admin/brand.php?status=updated&id=$brandID");
    }

    //header("Location: ../../admin/news.php?status=updated&id=$newsID");

}else{
    //header("Location: ../../admin/news.php?status=0");
}