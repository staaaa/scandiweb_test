<?php
    require_once('Product.php');
    class Furniture extends Product {
        public function set_attr($dimensions){
            $this->attr = $dimensions."M";
        }
        public function get_attr(){
            return $this->attr;
        }
    }
?>