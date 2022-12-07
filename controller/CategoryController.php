<?php
require_once("../db/dbconn.php");

class CategoryController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function navCat()
    {
        $catQuery = "SELECT * FROM category ORDER BY no_order ASC LIMIT 4 ";
        $result = $this->conn->query($catQuery);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function genderCat()
    {
        $catQuery = "SELECT * FROM category ORDER BY no_order ASC LIMIT 2";
        $result = $this->conn->query($catQuery);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function specialCat()
    {
        $catQuery = "SELECT * FROM category ORDER BY no_order ASC LIMIT 2,2";
        $result = $this->conn->query($catQuery);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
}