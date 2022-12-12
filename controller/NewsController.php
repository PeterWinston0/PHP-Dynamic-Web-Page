<?php
require_once("../db/dbconn.php");

class NewsController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function frontNews()
    {
        $newsQuery = "SELECT * FROM news ORDER BY id DESC LIMIT 3";
        $result = $this->conn->query($newsQuery);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function all()
    {
        $newsQuery = "SELECT * FROM news ORDER BY id DESC";
        $result = $this->conn->query($newsQuery);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
}
?>