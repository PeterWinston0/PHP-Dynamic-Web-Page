<?php require_once "../../DB/dbcon.php";
if (isset($_POST['id']) && isset($_POST['submit'])) {
    $title = $_POST['title'];
    $rubric = $_POST['rubric'];
    $content = $_POST['content'];
    $newsID = $_POST['id'];

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("UPDATE news SET `title`='$title', `rubric`='$rubric', `content`='$content' WHERE id=$newsID");
    $query->execute();
    header("Location: ../../admin/news.php?status=updated&id=$newsID");

}else{
    header("Location: ../../admin/news.php?status=0");
}