<?php
require_once("../db/dbcon.php");

$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM company_hours");
$query->execute();
$getComHours = $query->fetchAll();
?>

<div class="newsletter">
    <div class="newsletter-wrap">
    <p>Subscribe to out newsletter to follow up on the latest trends and out newest products</p>
    <div>
        <input class="newsletter-txt" placeholder="E-mail" type="text">
        <input class="newsletter-btn" type="button" value="Subscribe">
    </div>
    </div>
</div>

<footer>
    <div class="foot-wrap">
        <div class="foot-head">
            <h3>Sneaker Dreams</h3>
            <h4>Chase Your Dreams</h4>
        </div>
        <div class="hours">
            <?php
        foreach ($getComHours as $hours) {
        ?>
            <div class="">
                <div class="">
                    <p>
                        <?php echo $hours['day'] ?>
                        <?php echo $hours['time'] ?>
                    </p>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
        <div class="menu">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Men</a></li>
                <li><a href="#">Women</a></li>
                <li><a href="#">Limited</a></li>
                <li><a href="#">Sale</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
        <div class="social-text">
            <div class="">
                <i style="color: white;" class="fa fa-facebook" aria-hidden="true"></i>
                <i style="color: white;" class="fa fa-instagram" aria-hidden="true"></i>
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint
                commodi repudiandae consequuntur voluptatum laborum numquam blanditiis
                harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum!</p>
        </div>
        <div>
            <p class="copyright">
                Copyright &copy;
                <script>
                    document.write(new Date().getFullYear());
                </script> All rights reserved | <a href="" target="_blank">SneakerDreams.com</a>
            </p>
        </div>
    </div>
</footer>

<script type="text/javascript" src="../assets/js/main.js"></script>
<script src="../assets/js/cart.js"></script>

</body>

</html>