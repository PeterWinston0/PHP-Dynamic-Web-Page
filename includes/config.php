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

?>