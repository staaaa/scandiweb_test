<?php
    require_once('Product.php');
    class Book extends Product {
        public function set_attr($size){
            $this->attr = $size."KG";
        }
        public function get_attr(){
            return $this->attr;
        }
    }
?>