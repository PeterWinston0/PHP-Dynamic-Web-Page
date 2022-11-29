<?php 
    session_start();
    require "header.php";
     if(!isset($_SESSION['confirm_order']) || empty($_SESSION['confirm_order']))
     {
         header('location:index.php');
         exit();
     }
?>
<div class="row">
    <div class="col-md-12">
        <h1>Thank you!</h1>
        <p>
            Your order has been placed.
            <?php unset($_SESSION['confirm_order']);?>
        </p>
    </div>
</div>
<?php require ("footer.php")?>