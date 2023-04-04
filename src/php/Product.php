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

        function set_sku($sku){
            $this->sku = $sku;
        }
        function get_sku(){
            return $this->sku;
        }
        function set_name($name){
            $this->name = $name;
        }
        function get_name(){
            return $this->name;
        }
        function set_price($price){
            $this->price = $price;
        }
        function get_price(){
            return $this->price;
        }
        function set_attr($attr){
            $this->attr = $attr;
        }
        function set_furni_attr($height, $width, $length){
            $this->attr = $height.'x'.$width.'x'.$length;
        }
        function get_attr(){
            return $this->attr;
        }
    }
?>