<?php
// (A) LOAD CAPTCHA LIBRARY
require "captcha.php";

// (B) VERIFIED - DO SOMETHING
if ($PHPCAP->verify($_POST["captcha"])) {
  $result = "Congrats, CAPTCHA is correct.";
  //print_r($_POST);
  echo $result;
}

// (C) NOPE
else { echo "CAPTCHA does not match!"; }