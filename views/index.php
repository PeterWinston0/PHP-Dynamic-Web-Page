<?php
session_start();
$title = "Home Page";
require "../includes/layout/frontHeader.php";

require_once "../controller/NewsController.php";
require_once "../controller/ProductsController.php";
require_once "../controller/BrandController.php";
require_once "../controller/CategoryController.php";

$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM product, product_categories WHERE fk_product = product.id AND fk_category = 5");
$query->execute();
$getSpecialProd = $query->fetchAll();

$query = $dbCon->prepare("SELECT * FROM category ORDER BY no_order ASC LIMIT 2");
$query->execute();
$genderCat = $query->fetchAll();

$query = $dbCon->prepare("SELECT * FROM category ORDER BY no_order ASC LIMIT 2,2");
$query->execute();
$limitedSale = $query->fetchAll();

$query = $dbCon->prepare("SELECT * FROM company");
$query->execute();
$getCompanyInfo = $query->fetchAll();

$query = $dbCon->prepare("SELECT * FROM carousel");
$query->execute();
$getSlides = $query->fetchAll();
?>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>

</head>

<div class="container">
    <?php
    foreach ($getSlides as $slides) {
    ?>
    <div class="arrow arrow-left"><i class="fas fa-chevron-circle-left"></i></div>
    <img src="../crud/company/img/<?= $slides['image'] ?>" alt="">
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
    ?>
    <div class="arrow arrow-right"><i class="fas fa-chevron-circle-right"></i></div>
</div>

<script>
const imgs = document.querySelectorAll(".container img");
const dots = document.querySelectorAll(".dot i");
const leftArrow = document.querySelector(".arrow-left");
const rightArrow = document.querySelector(".arrow-right");

let currentIndex = 0;
let time = 5000; // default time for auto slideshow

const defClass = (startPos, index) => {
    for (let i = startPos; i < imgs.length; i++) {
        imgs[i].style.display = "none";
        dots[i].classList.remove("fa-dot-circle");
        dots[i].classList.add("fa-circle");
    }
    imgs[index].style.display = "block";
    dots[index].classList.add("fa-dot-circle");
};

defClass(1, 0);

leftArrow.addEventListener("click", function() {
    currentIndex <= 0 ? currentIndex = imgs.length - 1 : currentIndex--;
    defClass(0, currentIndex);
});

rightArrow.addEventListener("click", function() {
    currentIndex >= imgs.length - 1 ? currentIndex = 0 : currentIndex++;
    defClass(0, currentIndex);
});

const startAutoSlide = () => {
    setInterval(() => {
        currentIndex >= imgs.length - 1 ? currentIndex = 0 : currentIndex++;
        defClass(0, currentIndex);
    }, time);
};

startAutoSlide(); // Start the slideshow
</script>

<div class="block">
    <h2 class="myHead">Latest Drops</h2>
    <div class="carousel">
        <div class="">
            <button type="button" class="slick-prev">Previous</button>
            <div class="product-carousel car1">
                <?php
                $products = new ProductsController;
                $result = $products->index();
                if ($result) {
                    foreach ($result as $row) {
                ?>
                <a class="myLink" href="single-product.php?product=<?php echo $row['id'] ?>">
                    <div class="carousel-item">
                        <img src="../crud/products/img/<?= $row['image'] ?>" style="width: 100%"></img>
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

<script>
$(document).ready(function() {
    $(".car1").slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 3,
        appendArrows: $(".car1"),
        dots: false,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 3,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });
});
</script>

<div class="block">
    <h2 class="myHead">Popular Sneakers</h2>
    <div class="carousel">
        <div class="">
            <button type="button" class="slick-prev">Previous</button>
            <div class="product-carousel car2">
                <?php
                $products = new ProductsController;
                $result = $products->index();
                if ($result) {
                    foreach ($result as $row) {
                ?>
                <a class="myLink" href="single-product.php?product=<?php echo $row['id'] ?>">
                    <div class="carousel-item">
                        <img src="../crud/products/img/<?= $row['image'] ?>" style="width: 100%"></img>
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

<script>
$(document).ready(function() {
    $(".car2").slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 3,
        appendArrows: $(".car2"),
        dots: false,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 3,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });
});
</script>

<div class="page-container">
    <div class="gender-cat">
        <?php
        foreach ($genderCat as $gender) {
        ?>
        <div>
            <a href="products.php?cat_id=<?= $gender['cat_id'] ?>">
                <figure class="textover">
                    <img src='../crud/category/img/<?= $gender['image'] ?>' alt='images'>
                    <figcaption>
                        <?= $gender['title'] ?>
                    </figcaption>
                </figure>
            </a>
        </div>
        <?php
        }
        ?>
    </div>
</div>

<div class="page-container">
    <div class="block special-offer">
        <?php
    foreach ($getSpecialProd as $specialProd) {
    ?>
        <!-- <a class="myLink" href="single-product.php?product=<?php echo $specialProd['id'] ?>"></a> -->
        <div class="page-head">
            <h3>UGENS SNEAKER / <?= $specialProd['title'] ?>
            </h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi
                repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto
                fuga praesentium optio, eaque rerum!</p>
        </div>
        <div class="image">
            <img class="" src="../crud/products/img/<?= $specialProd['image'] ?>" alt="Card image cap">
        </div>
        <div class="text">
            <h2>
                <?= $specialProd['title'] ?>
            </h2>
            <h3>DKK <?= $specialProd['price'] ?>,-</h3>
            <p>
                <?= $specialProd['description'] ?>
            </p>
        </div>
        <?php
    }
    ?>
    </div>
</div>

<!-- <div class="block">
    <h2 class="myHead">Our Brands</h2>
    <div class="slider">
        <div class="slide-track">
            <?php
            $brand = new BrandController;
            $result = $brand->view();
            if ($result) {
                foreach ($result as $row) {
            ?>
            <div class="slide">
                <img src="../crud/brand/img/<?= $row['image'] ?>" height="100" width="250" alt="" />

            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div> -->



<div class="page-container">
    <div class="limited-sale">
        <?php
        foreach ($limitedSale as $special) {
        ?>

        <div>
            <a href="products.php?cat_id=<?= $special['cat_id'] ?>">
                <figure class="textover">
                    <img src='../crud/category/img/<?= $special['image'] ?>' alt='images'>
                    <figcaption>
                        <?= $special['title'] ?>
                    </figcaption>
                </figure>
            </a>
        </div>
        <?php
        }
        ?>
    </div>
</div>

<!-- ABOUT -->
<div class="about-wrap">
    <section class="section-about">
        <div class="page-container">
            <?php
            foreach ($getCompanyInfo as $companyInfo) {
            ?>
            <div class="about">
                <div class="image">
                    <img class="" src="../crud/company/img/<?= $companyInfo['image'] ?>" alt="Card image cap">
                </div>
                <div class="text">
                    <h2 class="">
                        <?php echo $companyInfo['title']; ?>
                    </h2>
                    <p>
                        <?php echo $companyInfo['description'] ?>
                    </p>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </section>
</div>

<!-- NEWS -->
<div class="page-container">
    <div class="row news">
        <h2 class="myHead">Check out our blog for the latest news</h2>
        <?php
        $news = new NewsController;
        $result = $news->index();
        if ($result) {
            foreach ($result as $row) {
        ?>

        <div class="example-1 card">
            <div class="wrapper">
                <img src="../crud/news/img/<?= $row['image'] ?>" alt="">
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

<script>
$(document).ready(function() {
            $(".row-eq").each(function() {
                equalColHeights($(this));
            });
            window.onresize = function() {
                $(".row-eq").each(function() {
                    equalColHeights($(this));
                });
            };

            const accordion = document.getElementsByClassName("container");

            for (i = 0; i < accordion.length; i++) {
                accordion[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                });
            }

            function equalColHeights(ele) {
                var highestCol = 0;
                $(ele)
                    .children(".col")
                    .each(function() {
                        $(this).css("height", "auto");
                        if (highestCol < $(this).height()) {
                            highestCol = $(this).height();
                        }
                        $(ele).children(".col").height(highestCol);
                    });
            }
        }
</script>

<?php require("../includes/layout/frontFooter.php") ?>