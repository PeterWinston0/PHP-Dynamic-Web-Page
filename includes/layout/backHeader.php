<!DOCTYPE html>
<html lang="en">
<?php
spl_autoload_register(
    function ($class) {
        include "../classes/" . $class . ".php";
    }
);
$session = new SessionHandle();
if ($session->confirm_logged_in()) {
    $redirect = new Redirector("login.php");
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.css" integrity="sha512-FA9cIbtlP61W0PRtX36P6CGRy0vZs0C2Uw26Q1cMmj3xwhftftymr0sj8/YeezDnRwL9wtWw8ZwtCiTDXlXGjQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  

    <!-- CK-EDITOR -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.18.0/ckeditor.js" integrity="sha512-woYV6V3QV/oH8txWu19WqPPEtGu+dXM87N9YXP6ocsbCAH1Au9WDZ15cnk62n6/tVOmOo0rIYwx05raKdA4qyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- JQUERY -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- CUSTOM -->
    <link rel="stylesheet" href="../assets/css/adminStyle.css">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="index.php">Sneaker Dreams Admin</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="index.php">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Products">
                    <a class="nav-link" href="products.php">
                        <i class="fa fa-fw fa-shopping-cart"></i>
                        <span class="nav-link-text">Products</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Categories">
                    <a class="nav-link" href="category.php">
                    <i class="fa-solid fa-icons"></i>
                        <span class="nav-link-text">Categories</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Brands">
                    <a class="nav-link" href="brand.php">
                    <i class="fa-regular fa-copyright"></i>
                        <span class="nav-link-text">Brands</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="News">
                    <a class="nav-link" href="news.php">
                    <i class="fa-solid fa-paper-plane"></i>
                        <span class="nav-link-text">News</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Company">
                    <a class="nav-link" href="company.php?com_id=1">
                    <i class="fa-solid fa-shop"></i>
                        <span class="nav-link-text">Company</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
                    <a class="nav-link" href="newUser.php">
                        <i class="fa fa-fw fa-users"></i>
                        <span class="nav-link-text">Users</span>
                    </a>
                </li>

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Order Overview">
                    <a class="nav-link" href="orderOverview.php">
                    <i class="fa-solid fa-truck"></i>
                        <span class="nav-link-text">Order Overview</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-fw fa-sign-out"></i>Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="content-wrapper">
        <div class="container-fluid">