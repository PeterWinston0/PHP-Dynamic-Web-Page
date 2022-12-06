<?php

class NewsController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function index()
    {
        $newsQuery = "SELECT * FROM news ORDER BY id DESC LIMIT 3";
        $result = $this->conn->query($newsQuery);
        if($result->num_rows > 0){
            return $result; 
        }else{
            return false;
        }
    }
}
?>