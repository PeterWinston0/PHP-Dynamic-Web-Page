<?php
require_once "../includes/config.php";
require_once "../includes/layout/backHeader.php";

//SAVE EDIT DATA
if (isset($_POST['news_id']) && isset($_POST['submit'])) {

    $dbCon = dbCon($user, $pass);

    $newsID = $_POST['news_id'];
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

        //header("Location: news.php?status=updated&id=$newsID");

    } else {

        move_uploaded_file($_FILES["imagename"]["tmp_name"], "../assets/img/" . $_FILES["imagename"]["name"]);

        $sql = "UPDATE news SET `title` = :title, `content` = :content, `image` = :news_image WHERE id = :news_id";
        $query = $dbCon->prepare($sql);
        $query->bindParam(':news_id', $newsID, PDO::PARAM_STR);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':content', $content, PDO::PARAM_STR);
        $query->bindParam(':news_image', $news_image, PDO::PARAM_STR);
        $query->execute();

        //header("Location: news.php?status=updated&id=$newsID");
    }
    //header("Location: ../../admin/news.php?status=updated&id=$newsID");
}else{
    //header("Location: ../../admin/news.php?status=0");
}

$imgid = intval($_GET['id']);
//LOAD EDIT DATA
if (isset($_GET['id'])) {
    $newsID = $_GET['id'];

    $dbCon = dbCon($user, $pass);

    $sql = "SELECT * FROM news WHERE id = :news_id";
    $query = $dbCon->prepare($sql);
    $query->bindParam(':news_id', $imgid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container">
    <?php
    foreach ($results as $result) {
        ?>
    <h3>Editing News "
        <?php echo $result->title; ?>"
    </h3>
    <form class="col s12" name="myNews" enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="input-field col s12">
                <input id="title" name="title" type="text" value="<?php echo $result->title; ?>" class="validate"
                    required="" aria-required="true">
                <label for="title">title</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input id="content" name="content" type="text" value="<?php echo $result->content; ?>" class="validate"
                    required="" aria-required="true">
                <label for="content">content</label>
            </div>
        </div>
        <div class="form-group ml-4">
            <label for="focusedinput" class="control-label">Current Image</label>
            <div class="">
                <img src="../assets/img/<?php echo $result->image; ?>" width="200">
            </div>
        </div>

        <div class="form-group ml-4">
            <label for="focusedinput" class=" control-label">New Image</label>
            <div class="">
                <input type="file" name="imagename" id="imagename">
            </div>
        </div>
        <?php
    }
            ?>
        <input type="hidden" name="news_id" value="<?php echo $newsID; ?>">
        <button class="btn waves-effect waves-light" type="submit" name="submit">Update
        </button>
    </form>
</div>

<?php } else {
    header("Location: news.php?status=0");
} ?>

<?php require "../includes/layout/backFooter.php"; ?>