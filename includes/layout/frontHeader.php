<?php
require_once "../controller/CategoryController.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $title; ?>
    </title>

    <!-- JQUERY -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- SLICK CAROUSEL -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
    <!-- FONT AWESOME -->
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <!-- CUSTOM -->
    <link rel="stylesheet" href="../assets/css/frontStyle.css">
</head>

<body>
    <nav class="nav-container">
        <h1><a href="index.php">Sneaker Dreams</a></h1>
        <div class="nav-btn">
            <a href="#" class="slide-toggle" style="color:#ffffff;">
                <i class="fas fa-search""></i>
            </a>

            <a href=" cart.php" style="color:#ffffff;">
                    <i class="fa fa-shopping-cart" "></i>
                <?php
                echo (isset($_SESSION['cart_items']) && count($_SESSION['cart_items'])) > 0 ? count($_SESSION['cart_items']) : '';
                ?>
            </a>

            <button id=" navbar-button">
                        <span></span>
                        <span></span>
                        <span></span>
                        </button>
        </div>

        <ul>
            <li><a href="index.php">Home</a></li>
            <?php
            $category = new CategoryController;
            $result = $category->navCat();
            if ($result) {
                foreach ($result as $row) {
            ?>
            <li><a class="nav-link" href="products.php?cat_id=<?= $row['cat_id'] ?>">
                    <?= $row['title'] ?>
                </a></li>
            <?php
                }
            }
            ?>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <ul class="nav-icons">
            <li><a class="slide-toggle" id="show" href="#" style="color:#ffffff;">
                    <i class="fas fa-search"></i>
                </a>
            </li>
            <li><a href="cart.php" style="color:#ffffff">
                    <i class="fa fa-shopping-cart"></i>
                    <?php
                    echo (isset($_SESSION['cart_items']) && count($_SESSION['cart_items'])) > 0 ? count($_SESSION['cart_items']) : '';
                    ?>
                </a>
            </li>
        </ul>
    </nav>

    <ul class="responsive-nav">
        <li><a href="index.php">Home</a></li>
        <?php
        $category = new CategoryController;
        $result = $category->navCat();
        if ($result) {
            foreach ($result as $row) {
        ?>
        <li><a class="nav-link" href="products.php?cat_id=<?= $row['cat_id'] ?>">
                <?= $row['title'] ?>
            </a></li>
        <?php
            }
        }
        ?>
        <li><a href="blog.php">Blog</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>

    <script>
        let navbarButton = document.querySelector("#navbar-button");
        let responsiveNav = document.querySelector('.responsive-nav');

        navbarButton.addEventListener('click', e => {
            responsiveNav.classList.toggle('responsive-nav-active')
        });
    </script>

    <div class="search-container">
        <form method="POST" action="../views/search.php">
            <div class="search-area">
                <input type="text" class="search-txt" name="keyword" placeholder="Search here..." required="required" />
                <button class="search-btn" name="search"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>

    <script>
        //SLIDE DOWN AND UP TOGGLE
        $(document).ready(function () {
            $(".search-container").hide();
            $(".slide-toggle").click(function () {
                $(".search-container").slideToggle();
            });
        });
    </script>