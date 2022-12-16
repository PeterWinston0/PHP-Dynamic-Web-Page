<?php

class ProductsController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function all()
    {
        $productsQuery = "SELECT * FROM product ORDER BY productID DESC";
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

    public function cheapProduct()
    {
        $productsQuery = "SELECT * FROM price_products";
        $result = $this->conn->query($productsQuery);
        if($result->num_rows > 0){
            return $result; 
        }else{
            return false;
        }
    }

    public function specialProduct()
    {
        $productsQuery = "SELECT * FROM product, product_categories WHERE product_categories.productID = product.productID AND catID = 5";
        $result = $this->conn->query($productsQuery);
        if($result->num_rows > 0){
            return $result; 
        }else{
            return false;
        }
    }
}
?>