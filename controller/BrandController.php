<?php
require_once("../db/dbconn.php");
class BrandController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function all()
    {
        $brandQuery = "SELECT * FROM brand";
        $result = $this->conn->query($brandQuery);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
}