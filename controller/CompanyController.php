<?php
require_once("../db/dbconn.php");

class CompanyController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function slides()
    {
        $companyQuery = "SELECT * FROM carousel";
        $result = $this->conn->query($companyQuery);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function companyInfo()
    {
        $companyQuery = "SELECT * FROM company";
        $result = $this->conn->query($companyQuery);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function orders()
    {
        $companyQuery = "SELECT * FROM orders ORDER BY o_id DESC";
        $result = $this->conn->query($companyQuery);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
}