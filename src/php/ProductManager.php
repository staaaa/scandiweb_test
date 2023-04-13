<?php
    abstract class ProductManager {
        public $conn;

        public function __construct($conn){
            $this->conn = $conn;
        }
        
        abstract public function addProduct($product);
        abstract public function deleteProduct($id);
        abstract public function getAllProducts();
        abstract public function getSku($sku);
    }
?>