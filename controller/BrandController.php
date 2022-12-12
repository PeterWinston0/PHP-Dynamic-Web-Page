<?php

class BrandController
{
    // public function __construct($username, $password)
    // {
    //     $db = new dbCon();
    // }

    // public function view()
    // {
    //     $db = new dbCon();
    //     $brandQuery = $db->dbCon->prepare = ("SELECT * FROM brand");
    //     $result = $brandQuery->execute();
    //     //$result = $this->conn->query($brandQuery);
    //     if ($result->num_rows > 0) {
    //         return $result;
    //     } else {
    //         return false;
    //     }
    // }

    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function view()
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