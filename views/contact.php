<?php
$title = "Contact Page";

require "../_test/captcha.php";
require "../includes/layout/frontHeader.php";

// function validating($phone){
//     if(preg_match('/^[0-9]{10}+$/', $phone)) {
//         echo "Valid Phone Number";
//         } else {
//         echo "Invalid Phone Number";
//         }
//     }

function validate($str) {
	return trim(htmlspecialchars($str));
}

$firstnameError = '';
$lastnameError = '';
$emailError = '';
$phoneError = '';
$messageError = '';

if (isset($_POST['contact-mail'])) {

    $firstname = validate($_POST['firstname']);
    $lastname = validate($_POST['lastname']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $message = validate($_POST['message']);


    if (!preg_match('/^[a-zA-Z0-9\s]+$/', $firstname)) {
        $firstnameError = 'Firstname can only contain letters, numbers and white spaces';
    }  
    if (!preg_match('/^[a-zA-Z0-9\s]+$/', $lastname)) {
        $lastnameError = 'Lastname can only contain letters, numbers and white spaces';
    } 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Invalid Email';
    }
    if (!filter_var($phone, FILTER_SANITIZE_NUMBER_INT)) {
        $phoneError = 'Invalid Phone Number';
    }
    if (!preg_match('/^[a-zA-Z0-9\s]+$/', $message)) {
        $messageError = 'Message can only contain letters, numbers and white spaces';
    } 

    //get data from form  
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email= $_POST['email'];
    $phone= $_POST['phone'];
    $message= $_POST['message'];
    $to = "peterwinston1993@hotmail.com";
    $subject = "Mail From website";

    $txt ="FirstName = ". $firstname . "\r\n LastName = ". $lastname . "\r\n Email = " . $email . "\r\n Phone=" . $phone ."\r\n Message =" . $message;
    $headers = "From: noreply@yoursite.com";
    if($email!=NULL){
        mail($to,$subject,$txt,$headers);
    }


    //redirect
    //header("Location:thankyou.html");
}

?>

<div class="page-container">
    <div class="contact-container">
        <div class="innerwrap">

            <section class="section1 clearfix">
                <div class="textcenter">
                    <h1>Feel Free To Contact Us</h1>
                </div>
            </section>

            <section class="section2 clearfix">
                <div class="col2 column1 first">
                    <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
                    <div class="sec2map" style='overflow:hidden;height:550px;width:100%;'>
                        <div id='gmap_canvas' style='height:100%;width:100%;'></div>
                        <div><small><a href="http://embedgooglemaps.com"> embed google maps </a></small></div>
                        <div><small><a href="http://freedirectorysubmissionsites.com/">free web directories</a></small>
                        </div>
                        <style>
                        #gmap_canvas img {
                            max-width: none !important;
                            background: none !important
                        }
                        </style>
                    </div>
                    <script type='text/javascript'>
                    function init_map() {
                        var myOptions = {
                            zoom: 14,
                            center: new google.maps.LatLng(19.075314480255834, 72.88153973865361),
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
                        marker = new google.maps.Marker({
                            map: map,
                            position: new google.maps.LatLng(19.075314480255834, 72.88153973865361)
                        });
                        infowindow = new google.maps.InfoWindow({
                            content: '<strong>My Location</strong><br>mumbai<br>'
                        });
                        google.maps.event.addListener(marker, 'click', function() {
                            infowindow.open(map, marker);
                        });
                        infowindow.open(map, marker);
                    }
                    google.maps.event.addDomListener(window, 'load', init_map);
                    </script>
                </div>
                <div class="col2 column2 last">
                     <div class="sec2innercont">
                        <div class="sec2addr">
                            <p>45 BC, a Latin professor at Hampden-Sydney College in Virginia</p>
                            <p><span class="collig">Phone :</span> +91 976885083</p>
                            <p><span class="collig">Email :</span> vivek.mengu016@gmail.com</p>
                            <p><span class="collig">Fax :</span> +91 9768850839</p>
                        </div>
                    </div> 
                    <div class="sec2contactform">
                        <h3 class="sec2frmtitle">Want to Know More?? Drop Us a Mail</h3>
                        <?php// echo htmlspecialchars($_SERVER["PHP_SELF"]);?>
                        <!-- <form method="post" action="../_test/submit.php"> -->
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="clearfix">
                                <p><?php echo $firstnameError ?></p>
                                <input class="col2 first" type="text" name="firstname" placeholder="FirstName">
                                <p><?php echo $lastnameError ?></p>
                                <input class="col2 last" type="text" name="lastname" placeholder="LastName">
                            </div>
                            <div class="clearfix">
                                <p><?php echo $emailError ?></p>
                                <input class="col2 first" type="text" name="email" placeholder="Email">
                                <p><?php echo $phoneError ?></p>
                                <input class="col2 last" type="text" name="phone" placeholder="Contact Number">
                            </div>
                            <div class="clearfix">
                            <p><?php echo $messageError ?></p>
                                <textarea name="message" cols="30" rows="7">Your message here...</textarea>
                                
                             <!-- (B) CAPTCHA HERE -->
                            <label>Are you human?</label>
                            <?php
                                $PHPCAP->prime();
                                $PHPCAP->draw();
                            ?>
                            <input name="captcha" type="text">
                            
                            <div class="clearfix"><input type="submit" name="contact-mail" value="Send"></div>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>

    </div>
<?php
require "../includes/layout/frontFooter.php";
?>