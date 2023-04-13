<?php
    require_once('Product.php');
    class Dvd extends Product {
        public function set_attr($size){
            $this->attr = $size."MB";
        }
        public function get_attr(){
            return $this->attr;
        }
    }
?>