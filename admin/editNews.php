<?php require_once "../../DB/dbcon.php";
if (isset($_GET['id'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit News</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<?php
$newsID = $_GET['id'];
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM news WHERE ID=$newsID");
$query->execute();
$getNews = $query->fetchAll();
?>
<body>

<div class="container">
        <h3>Editing News "<?php echo $getNews[0][1]; ?>"</h3>
        <form class="col s12" name="myNews" method="post" action="updateNews.php">
            <div class="row">
                <div class="input-field col s12">
                    <input id="title" name="title" type="text" value="<?php echo $getNews[0][1]; ?>" class="validate" required="" aria-required="true">
                    <label for="title">title</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="rubric" name="rubric" type="text" value="<?php echo $getNews[0][2]; ?>" class="validate" required="" aria-required="true">
                    <label for="rubric">rubric</label>
                </div>
                <div class="input-field col s6">
                    <input id="content" name="content" type="text" value="<?php echo $getNews[0][3]; ?>" class="validate" required="" aria-required="true">
                    <label for="content">content</label>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $newsID; ?>">
            <button class="btn waves-effect waves-light" type="submit" name="submit">Update
            </button>
        </form>
    </div>
</div>
</body>
</html>
<?php }else{header("Location: ../../admin/news.php?status=0");}?>