<?php
$title = "Contact Page";

require_once('../includes/helpers.php');
//require "../_test/captcha.php";
require "../classes/captcha.php";
require "../includes/layout/frontHeader.php";

function validate($str)
{
    return trim(htmlspecialchars($str));
}

$firstnameError = '';
$lastnameError = '';
$emailError = '';
$phoneError = '';
$messageError = '';
$captchaError = '';

if (isset($_POST['submit'])) {

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
    // (B) VERIFIED - DO SOMETHING
    else if ($PHPCAP->verify($_POST["captcha"])) {
        $result = "Congrats, CAPTCHA is correct.";
        //print_r($_POST);
        echo $result;

        //get data from form  
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        $to = "peterwinston1993@hotmail.com";

        $subject = "Mail From SneakerDreams";

        $txt = "FirstName = " . $firstname . "\r\n LastName = " . $lastname . "\r\n Email = " . $email . "\r\n Phone=" . $phone . "\r\n Message =" . $message;
        $headers = "From: contact@itspeterwinston.com";
        if ($email != NULL) {
            mail($to, $subject, $txt, $headers);
        }
    }
    // (C) NOPE
    else {
        $captchaError = "CAPTCHA does not match!";
    }
}
?>
<div class="page-container">
<i class="fa-solid fa-truck"></i>
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
                        <div class="mapouter">
                            <div class="gmap_canvas"><iframe width="100%" height="100%" id="gmap_canvas"
                                    src="https://maps.google.com/maps?q=Spangbjerg%20kirkevej%20123&t=k&z=13&ie=UTF8&iwloc=&output=embed"
                                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col2 column2 last">
                    <div class="sec2contactform">
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="clearfix">
                                <p>
                                    <?php echo $firstnameError ?>
                                </p>
                                <input class="col2 first" type="text" name="firstname" placeholder="First Name">
                                <p>
                                    <?php echo $lastnameError ?>
                                </p>
                                <input class="col2 last" type="text" name="lastname" placeholder="Last Name">
                            </div>
                            <div class="clearfix">
                                <p>
                                    <?php echo $emailError ?>
                                </p>
                                <input class="col2 first" type="text" name="email" placeholder="Email">
                                <p>
                                    <?php echo $phoneError ?>
                                </p>
                                <input class="col2 last" type="text" name="phone" placeholder="Contact Number">
                            </div>
                            <div class="clearfix">
                                <p>
                                    <?php echo $messageError ?>
                                </p>
                                <textarea name="message" cols="30" placeholder="Your message here..."
                                    rows="7"></textarea>

                                <!-- (B) CAPTCHA HERE -->
                                <div class="captcha">
                                    <p>Are you human?</p>
                                    <p>
                                        <?php echo $captchaError ?>
                                    </p>
                                </div>
                                <div class="captcha">
                                    <?php
                                    $PHPCAP->prime();
                                    $PHPCAP->draw();
                                    ?>
                                </div>
                                <div class="captcha">
                                    <input placeholder="Enter Captcha" name="captcha" type="text">
                                </div>

                                <div class="clearfix"><input type="submit" name="submit" value="Send"></div>
                            </div>
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