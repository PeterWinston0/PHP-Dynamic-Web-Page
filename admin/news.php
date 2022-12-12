<?php
require_once "../DB/dbcon.php";
require "../includes/layout/backHeader.php";

require_once "../controller/NewsController.php";
?>

<div class="container">
    <ul class="nav-tabs">
        <li class="active-tab" data-link="page-1">All News</li>
        <li data-link="page-2">New</li>
    </ul>
    <div class="content active" id="page-1">
        <div class="column">
            <h2>All News</h2>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Rubric</th>
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
                            echo "<td>" . $row['rubric'] . "</td>";
                            echo "<td>" . substr($row['content'], 0, 150) . "</td>";
                            echo "<td>" . "<img src='../crud/news/img/" . $row['image'] . "' width='120' height='120' alt='images'>" . "</td>";

                            echo "<td>";

                            echo "</td>";
                            echo '<td><a href="../crud/news/editNews.php?id=' . $row['id'] . '" class="waves-effect waves-light btn" ">Edit</a></td>';
                            echo '<td><a href="../crud/news/deleteNews.php?id=' . $row['id'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="content" id="page-2">
        <div class="column">
            <h3>Add New Article</h3>
            <form class="col s12" name="news" method="post" enctype="multipart/form-data"
                action="../crud/news/addNews.php">
                <div class="column">
                    <div class="input-field">
                        <label class="w-100 p-1" for="title">title</label>
                        <input id="title" name="title" type="text" class="validate w-75 p-2" required=""
                            aria-required="true">
                    </div>
                    <div class="input-field">
                        <label class="w-100 p-1" for="rubric">rubric</label>
                        <input id="rubric" name="rubric" type="text" class="validate w-75 p-2" aria-required="true">
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
</div>

<!-- Script -->
<script type="text/javascript">
    CKEDITOR.replace('content', {
        height: "200px"
    }); 
</script>

<?php require "../includes/layout/backFooter.php"; ?>