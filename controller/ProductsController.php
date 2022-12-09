<?php

class ProductsController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function index()
    {
        $productsQuery = "SELECT * FROM product ORDER BY id DESC LIMIT 12";
        $result = $this->conn->query($productsQuery);
        if($result->num_rows > 0){
            return $result; 
        }else{
            return false;
        }
    }

    public function latestProduct()
    {
        $productsQuery = "SELECT * FROM latest_products";
        $result = $this->conn->query($productsQuery);
        if($result->num_rows > 0){
            return $result; 
        }else{
            return false;
        }
    }

    public function specialProduct()
    {
        $productsQuery = "SELECT * FROM product, product_categories WHERE fk_product = product.id AND fk_category = 5";
        $result = $this->conn->query($productsQuery);
        if($result->num_rows > 0){
            return $result; 
        }else{
            return false;
        }
    }
}
?>