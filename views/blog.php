<?php
session_start();
$title = "Home Page";
require "../includes/layout/frontHeader.php";
require_once "../controller/NewsController.php";
?>
<div class="page-container">
<h2 class="block-title">News</h2>
    <div class="news-container">
        <?php
        $news = new NewsController;
        $result = $news->all();
        if ($result) {
            foreach ($result as $row) {
        ?>

        <div class="example-1 card">
            <div class="wrapper">
                <img src="../assets/img/<?= $row['image'] ?>" alt="">
                <div class="date">
                    <span class="day">12</span>
                    <span class="month">Aug</span>
                    <span class="year">2016</span>
                </div>
                <div class="data">
                    <div class="content">
                        <span class="author">Jane Doe</span>
                        <h1 class="title"><a href="single-news.php?id=<?= $row['id'] ?>">
                                <?= $row['title'] ?>
                            </a></h1>
                        <p class="text">
                            <?= substr($row['content'], 0, 150) ?>'...
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        }
        ?>
    </div>
</div>
<?php require "../includes/layout/frontFooter.php"; ?>