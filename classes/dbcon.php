<?php

class dbCon
{
    private $dsn = 'mysql:dbname=mywebshop;host=localhost;charset=utf8';
    private $user = "root";
    private $pass = "";
    public $dbCon;
    public function __construct()
    {
        $dsn = $this->dsn;
        $user = $this->user;
        $pass = $this->pass;

        try {
            $this->dbCon = new PDO($dsn, $user, $pass);
            // return $this -> dbCon;
        } catch (PDOException $err) {
            echo "Error!: " . $err->getMessage() . "<br/>";
            die();
        }
    }

    public function DBClose()
    {
        $this->dbCon = null;
    }
}