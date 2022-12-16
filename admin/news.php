<?php
require_once "../includes/config.php";
require "../includes/layout/backHeader.php";
require_once "../controller/NewsController.php";

$upSucces = '';

$titleErr = '';
$contentErr = '';
$imageErr = '';

if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $content = $_POST['content'];

    $title = trim($_POST['title']);
    if (empty($title)) {
        $titleErr = "Please enter product title";
    } else if (!preg_match('/^[a-zA-Z0-9\s]+$/', $title)) {
        $titleErr = "Title can only contain letters, numbers and white spaces";
    } else {

        //Content
        $content = trim($_POST['content']);
        if (empty($content)) {
            $descErr = "Please enter product description";
        } else {
            $file = $_FILES["file"]['tmp_name'];
            list($width, $height) = getimagesize($file);
            if (
                (($_FILES['file']['type'] == "image/gif") ||
                    ($_FILES['file']['type'] == "image/jpeg") ||
                    ($_FILES['file']['type'] == "image/png") ||
                    ($_FILES['file']['type'] == "image/webp") ||
                    ($_FILES['file']['type'] == "image/pjpeg")) &&
                ($_FILES['file']['size'] < 10000000)
            ) {
                if ($_FILES['file']['error'] > 0) {
                    echo "error code: " . $_FILES['file']['error'];
                } else {
                    if (file_exists("../assets/img/" . $_FILES['file']['name'])) {
                        echo "no dude, you already have tha file!";
                    } else if ($width > "2000" || $height > "1200") {
                        $imageErr = "Error : image size must smaller than 2000 x 1200 pixels.";
                    } else {
                        move_uploaded_file($_FILES['file']['tmp_name'], "../assets/img/" . $_FILES['file']['name']);
                        $myFile = $_FILES['file']['name'];
                        $dbCon = dbCon($user, $pass);
                        $query = $dbCon->prepare("INSERT INTO news(`title`, `content`, `image`) VALUES ('$title', '$content','$myFile')");
                        $query->execute();
                        $upSucces = 'status added';
                    }
                }
            } else {
                echo "invalid file!";
            }
        }
    }
}

if (isset($_GET['delete'])) {
    $newsID = $_GET['delete'];
    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("DELETE FROM news WHERE id=$newsID");
    $query->execute();

    //header("Location: ../../admin/news.php?status=deleted&id=$newsID");
}else{
    //header("Location: ../../admin/news.php?status=0");
}
?>

<div class="container">
    <ul class="nav-tabs">
        <li class="active-tab" data-link="page-1">New Article</li>
        <li data-link="page-2">All News</li>
    </ul>
    <div class="content active" id="page-1">
        <div class="column">
            <h3>Add New Article</h3>
            <form class="col s12" name="news" method="post" enctype="multipart/form-data">
                <div class="column">
                    <div class="input-field">
                        <label class="w-100 p-1" for="title">title</label>
                        <input id="title" name="title" type="text" class="validate w-75 p-2" required=""
                            aria-required="true">
                    </div>
                    <div class="input-field">
                        <label class="w-100 p-1" for="content">content</label>
                        <textarea id="content" name="content" type="text" class="validate w-75 p-2"
                            aria-required="true"></textarea>
                    </div>
                    <div class="input-field">
                        <label class="w-100 p-1" for="">Image</label>
                        <input type='file' name='file' />
                    </div>
                </div>
                <br>
                <button class="btn btn-dark" type="submit" name="submit">Add Article
                </button>
            </form>
            <hr>
        </div>
    </div>
    <div class="content" id="page-2">
        <div class="column">
            <h2>All News</h2>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $news = new NewsController;
                    $result = $news->all();
                    if ($result) {
                        foreach ($result as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . substr($row['content'], 0, 150) . "</td>";
                            echo "<td>" . "<img src='../assets/img/" . $row['image'] . "' width='120' height='120' alt='images'>" . "</td>";

                            echo "<td>";

                            echo "</td>";
                            echo '<td><a href="editNews.php?id=' . $row['id'] . '" class="waves-effect waves-light btn" ">Edit</a></td>';
                            echo '<td><a href="news.php?delete=' . $row['id'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script -->
<script type="text/javascript">
    CKEDITOR.replace('content', {
        height: "200px"
    }); 
</script>

<?php require "../includes/layout/backFooter.php"; ?>