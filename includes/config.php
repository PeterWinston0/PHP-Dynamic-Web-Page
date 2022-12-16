<?php

$user = "root";
$pass = "";

function dbCon($user, $pass)
{
    try {
        $dbCon = new PDO('mysql:host=localhost;dbname=mywebshop;charset=utf8', $user, $pass);
        //$dbCon = null;
        return $dbCon;
    } catch (PDOException $err) {
        echo "Error!: " . $err->getMessage() . "<br/>";
        die();
    }

}



// // THIS WORKS AND IS THE CONNECTION 
// $dsn = 'mysql:dbname=mywebshop;host=localhost;charset=utf8';
// $user = 'root';
// $pass = '';

// try {
// 	$db = new PDO($dsn, $user, $pass);
// 	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $err) {
// 	echo "PDO Error! " . $err->getMessage() . "<br/>";
// 	die();
// }

?>