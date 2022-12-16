<?php
session_start();
$title = "Home Page";
require "../includes/layout/frontHeader.php";
require_once "../controller/NewsController.php";
require_once "../controller/ProductsController.php";
require_once "../controller/BrandController.php";
require_once "../controller/CategoryController.php";
require_once "../controller/CompanyController.php";
?>

<div class="container">
    <?php
    $company = new CompanyController;
    $result = $company->slides();
    if ($result) {
        foreach ($result as $row) {
    ?>
    <div class="arrow arrow-left"><i class="fas fa-chevron-circle-left"></i></div>
    <img src="../assets/img/<?= $row['image'] ?>" alt="">
    <div class="dots">
        <div class="dot">
            <i class="far fa-dot-circle"></i>
        </div>
        <div class="dot">
            <i class="far fa-circle"></i>
        </div>
        <div class="dot">
            <i class="far fa-circle"></i>
        </div>
    </div>
    <?php
        }
    }
    ?>
    <div class="arrow arrow-right"><i class="fas fa-chevron-circle-right"></i></div>
</div>

<div class="page-container">
    <h2 class="block-title">Latest Drops</h2>
    <div class="carousel">
        <div class="">
            <button type="button" class="slick-prev">Previous</button>
            <div class="product-carousel car1">
                <?php
                $products = new ProductsController;
                $result = $products->latestProduct();
                if ($result) {
                    foreach ($result as $row) {
                ?>
                <a class="myLink" href="single-product.php?product=<?php echo $row['productID'] ?>">
                    <div class="carousel-item">
                        <img src="../assets/img/<?= $row['image'] ?>" style="width: 100%"></img>
                        <p>
                            <?= $row['title'] ?>
                        </p>
                        <p>DKK <?= $row['price'] ?>
                        </p>
                    </div>
                </a>
                <?php
                    }
                }
                ?>
                <button type="button" class="slick-next">Next</button>
            </div>
        </div>
    </div>
</div>

<div class="page-container">
    <h2 class="block-title">Popular Sneakers</h2>
    <div class="carousel">
        <div class="">
            <button type="button" class="slick-prev">Previous</button>
            <div class="product-carousel car2">
                <?php
                $products = new ProductsController;
                $result = $products->cheapProduct();
                if ($result) {
                    foreach ($result as $row) {
                ?>
                <a class="myLink" href="single-product.php?product=<?php echo $row['productID'] ?>">
                    <div class="carousel-item">
                        <div class="img-wrap">
                            <img src="../assets/img/<?= $row['image'] ?>" style="width: 100%"></img>
                        </div>
                        <p>
                            <?= $row['title'] ?>
                        </p>
                        <p>DKK <?= $row['price'] ?>
                        </p>
                    </div>
                </a>
                <?php
                    }
                }
                ?>
                <button type="button" class="slick-next">Next</button>
            </div>
        </div>
    </div>
</div>

<div class="page-container">
    <div class="gender-cat">
        <?php
        $category = new CategoryController;
        $result = $category->genderCat();
        if ($result) {
            foreach ($result as $row) {
        ?>
        <div>
            <a href="products.php?cat_id=<?= $row['catID'] ?>">
                <figure class="textover">
                    <img src='../assets/img/<?= $row['image'] ?>' alt='images'>
                    <figcaption>
                        <?= $row['title'] ?>
                    </figcaption>
                </figure>
            </a>
        </div>
        <?php
            }
        }
        ?>
    </div>
</div>

<div class="page-container">
    <div class="block special-offer">
        <?php
        $products = new ProductsController;
        $result = $products->specialProduct();
        if ($result) {
            foreach ($result as $row) {
        ?>
        <div class="special-head">
            <h3>UGENS SNEAKER / <?= $row['title'] ?>
            </h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi
                repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto
                fuga praesentium optio, eaque rerum!</p>
        </div>
        <a class="special-link" href="single-product.php?product=<?php echo $row['productID'] ?>">
        <div class="image">
            <img class="" src="../assets/img/<?= $row['image'] ?>" alt="Card image cap">
        </div>
        
        <div class="text">
            <h2>
                <?= $row['title'] ?>
            </h2>
            <h3>DKK <?= $row['price'] ?>,-</h3>
            <p>
                <?= $row['description'] ?>
            </p>
        </div>
        </a>
        <?php
            }
        }
        ?>
    </div>
</div>

<div class="page-container">
    <div class="limited-sale">
        <?php
        $category = new CategoryController;
        $result = $category->specialCat();
        if ($result) {
            foreach ($result as $row) {
        ?>
        <div>
            <a href="products.php?cat_id=<?= $row['catID'] ?>">
                <figure class="textover">
                    <img src='../assets/img/<?= $row['image'] ?>' alt='images'>
                    <figcaption>
                        <?= $row['title'] ?>
                    </figcaption>
                </figure>
            </a>
        </div>
        <?php
            }
        }
        ?>
    </div>
</div>

<!-- ABOUT -->
<div class="about-wrap">
    <section class="section-about">
        <div class="page-container">
            <?php
            $company = new CompanyController;
            $result = $company->companyInfo();
            if ($result) {
                foreach ($result as $row) {
            ?>
            <div class="about">
                <div class="image">
                    <img src="../assets/img/<?= $row['image'] ?>" alt="Card image cap">
                </div>
                <div class="text">
                    <h2>
                        <?php echo $row['title']; ?>
                    </h2>
                    <p>
                        <?php echo $row['description'] ?>
                    </p>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </section>
</div>

<!-- NEWS -->
<div class="page-container">
    <div class="row news">
        <h2 class="block-title">Check out our blog for the latest news</h2>
        <?php
        $news = new NewsController;
        $result = $news->frontNews();
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
    <div class="more-wrap">
        <a class="more-btn" href="blog.php">Look some more</a>
    </div>
</div>

<script type="text/javascript" src="../assets/js/main.js"></script>
<?php require("../includes/layout/frontFooter.php") ?>