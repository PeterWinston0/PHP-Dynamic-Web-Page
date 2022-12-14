<?php

$host = "localhost"; /* Host name */
$user = "peter"; /* User */
$password = "1234"; /* Password */
$dbname = "webshop"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 	die("Connection failed: " . mysqli_connect_error());
}