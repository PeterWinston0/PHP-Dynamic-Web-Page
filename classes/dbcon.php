<?php

class dbCon
{
	private $dsn = 'mysql:dbname=webshop;host=localhost;charset=utf8';
    private $user = "peter";
    private $pass = "1234";
    public $dbCon;
    public function __construct(){
		$dsn = $this->dsn;
        $user = $this->user;
        $pass = $this->pass;

        try {
            $this->dbCon = new PDO($dsn, $user, $pass);
            // return $this -> dbCon;
        } catch (PDOException $err) {
            echo "Error!: " . $err->getMessage() . "<br/>";
            die();
        }}

    public function DBClose(){
        $this->dbCon = null;
    }
}

// class DbCon
// {
//     private $user = "peter";
//     Private $pass = "1234";
//     public $dbCon;
//     public function __construct(){
//         $user = $this->user;
//         $pass = $this->pass;

//         try {
//             $this->dbCon = new PDO('mysql:host=localhost;dbname=webshop;charset=utf8', $user, $pass);
//             return $this->dbCon;
//         } catch (PDOException $err) {
//             echo "Error!: " . $err->getMessage() . "<br/>";
//             die();
//         }}

//     public function DBClose(){
//         $this->dbCon = null;
//     }
// }