<?php
$user = "peter";
$pass = "1234";

function dbCon($user, $pass)
{
    try {
        $dbCon = new PDO('mysql:host=localhost;dbname=webshop;charset=utf8', $user, $pass);
        //$dbCon = null;
        return $dbCon;
    } catch (PDOException $err) {
        echo "Error!: " . $err->getMessage() . "<br/>";
        die();
    }}