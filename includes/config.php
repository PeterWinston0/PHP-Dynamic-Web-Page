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

// class dbCon
// {
// 	private $dsn = 'mysql:dbname=webshop;host=localhost;charset=utf8';
//     private $user = "peter";
//     private $pass = "1234";
//     public $dbCon;
//     public function __construct(){
// 		$dsn = $this->dsn;
//         $user = $this->user;
//         $pass = $this->pass;

//         try {
//             $this->dbCon = new PDO($dsn, $user, $pass);
//             // return $this -> dbCon;
//         } catch (PDOException $err) {
//             echo "Error!: " . $err->getMessage() . "<br/>";
//             die();
//         }}

//     public function DBClose(){
//         $this->dbCon = null;
//     }
// }

// define('PRODUCT_IMG_URL', '../crud/products/img/');


?>