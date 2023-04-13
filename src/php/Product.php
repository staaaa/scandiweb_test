<?php
    class Product{
        private $sku;
        private $name;
        private $price;
        private $attr;
        
        public function __construct($sku, $name, $price){
            $this->sku = $sku;
            $this->name = $name;
            $this->price = $price;
        }
        public function set_sku($sku){
            $this->sku = $sku;
        }
        public function get_sku(){
            return $this->sku;
        }
        public function set_name($name){
            $this->name = $name;
        }
        public function get_name(){
            return $this->name;
        }
        public function set_price($price){
            $this->price = $price;
        }
        public function get_price(){
            return $this->price;
        }
        public function set_attr($attr){
            $this->attr = $attr;
        }
        public function get_attr(){
            return $this->attr;
        }
    }
?>