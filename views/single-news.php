<?php
session_start();
$title = "Products Page";
require "../includes/layout/frontHeader.php";

$news_id = (int) $_GET['id'];

$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM news WHERE id = $news_id");
$query->execute();
$getNews = $query->fetchAll();

$query = $dbCon->prepare("SELECT * FROM news");
$query->execute();
$getAllNews = $query->fetchAll();
?>

<div class="page-container">
    <div class="news-container" style="">
        <div class="single-news">
            <?php
        foreach ($getNews as $news) {
        ?>

            <img class="" src="../crud/news/img/<?= $news['image'] ?>" alt="Card image cap">
            <div class="body">
                <h2 class="title">
                    <?= $news['title'] ?>
                </h2>
                <p class="text">
                    <?= $news['content'] ?>
                </p>
            </div>


            <?php
        }
        ?>

        </div>
        <div class="all-news">
            <?php
        foreach ($getAllNews as $allNews) {
        ?>
        <div>
            <img class="" src="../crud/news/img/<?= $allNews['image'] ?>" alt="Card image cap">
            <h4 class="title">
                <?= $allNews['title'] ?>
            </h4>
            </div>
            <?php
        }
        ?>
        </div>
    </div>
</div>
<?php require "../includes/layout/frontFooter.php"; ?>