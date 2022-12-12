<?php

// THIS WORKS AND IS THE CONNECTION 

$dsn = 'mysql:dbname=webshop;host=localhost;charset=utf8';
$user = 'peter';
$pass = '1234';

try {
	$db = new PDO($dsn, $user, $pass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
	echo "PDO Error! " . $err->getMessage() . "<br/>";
	die();
}


define('PRODUCT_IMG_URL', '../crud/products/img/');




// // Report runtime errors
// error_reporting(E_ERROR | E_WARNING | E_PARSE);

// // Report all errors
// error_reporting(E_ALL);

// // Same as error_reporting(E_ALL);
// ini_set("error_reporting", E_ALL);

// // Report all errors except E_NOTICE
// error_reporting(E_ALL & ~E_NOTICE);
?>