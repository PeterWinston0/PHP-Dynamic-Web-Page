<?php
require_once "../DB/dbcon.php";
require "../includes/layout/backHeader.php";
?>

<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM news");
$query->execute();
$getNews = $query->fetchAll();
?>

<head>
    <style>
        .content {
            width: 90%;
            display: none;
        }

        .active {
            display: block;
        }

        .nav-tabs {
            list-style-type: none;
            padding: 5px;
        }

        .nav-tabs li {
            display: inline;
            padding: 5px 10px;
            background: lightgrey;
            cursor: pointer;
        }

        li.active-tab {
            background: lightblue;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>

<body>

    <div class="container">
        <!-- <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == "deleted") {
                echo "The entry " . $_GET['id'] . " has been successfully deleted!";
                echo "<script>M.toast({html: 'Deleted!'})</script>";
            } elseif ($_GET['status'] == "updated") {
                echo "The entry " . $_GET['id'] . " has been successfully Updated!";
                echo "<script>M.toast({html: 'Updated!'})</script>";
            } elseif ($_GET['status'] == "added") {
                echo "The new entry has been successfully added!";
                echo "<script>M.toast({html: 'Added!'})</script>";
            }
        }
        ?> -->

        <ul class="nav-tabs">
            <li class="active-tab" data-link="page-1">All</li>
            <li data-link="page-2">New</li>
            <li data-link="page-3">Third Page</li>
            <li data-link="page-4">Fourth Page</li>
        </ul>
        <div class="content active" id="page-1">
            <div class="column">

                <h2>All News</h2>
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>NewsID</th>
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
                    foreach ($getNews as $getNews) {

                        echo "<tr>";

                        echo "<td>" . $getNews['id'] . "</td>";
                        echo "<td>" . $getNews['title'] . "</td>";
                        echo "<td>" . $getNews['rubric'] . "</td>";
                        echo "<td>" . substr($getNews['content'], 0, 150) . "</td>";
                        echo "<td>" . "<img src='../crud/news/img/" . $getNews['image'] . "' width='120' height='120' alt='images'>" . "</td>";

                        echo "<td>";

                        echo "</td>";
                        echo '<td><a href="../crud/news/editNews.php?id=' . $getNews['id'] . '" class="waves-effect waves-light btn" ">Edit</a></td>';
                        echo '<td><a href="../crud/news/deleteNews.php?id=' . $getNews['id'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';
                        echo "</tr>";
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
        <div class="content" id="page-3">
            This is going to be the content for the third page. This block isn't even visible until jQuery and user
            action makes it so. </div>
        <div class="content" id="page-4">
            This is going to be the content for the fourth page. This block isn't even visible until jQuery and user
            action makes it so. </div>

    </div>
    </div>
</body>

<!-- Script -->
<script type="text/javascript">
    CKEDITOR.replace('content', {
        height: "200px"
    }); 
</script>
<script>
    // page is ready to go via HTML, jquery only comes into play when user interacts. 
    $(".nav-tabs li").click(function () {
        // only executes if tab/page not active
        if (!$(this).hasClass('active-tab')) {
            $(".nav-tabs li").removeClass("active-tab");
            $(this).addClass('active-tab');
            var page = "#" + $(this).attr("data-link");
            $(".content").removeClass('active');
            $(page).addClass('active');
        }
    });
</script>

</html>

<?php require "../includes/layout/backFooter.php"; ?>