<?php
    require('ProductManager.php');
    class ProductManagerImpl extends ProductManager {
        public function addProduct($product){
            $sku = $product->get_sku();
            $name = $product->get_name();
            $price = $product->get_price();
            $attr = $product->get_attr();

            $sql = "INSERT INTO products (sku, name, price, attr) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ssss', $sku, $name, $price, $attr);
            $stmt->execute();
            
            $response = array();
            $response[0] = $sku;
            $response[1] = $name;
            $response[2] = $price;
            $response[3] = $attr;
            return $response;
        }
        public function deleteProduct($id){
            $sql = "DELETE FROM products WHERE id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            
            return $stmt->affected_rows > 0;
        }
        public function getAllProducts(){
            $response = array();
            $sql = "SELECT * FROM products";
            $result = $this->conn->query($sql);
        
            $i = 0;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $response[$i] = array($row['id'], $row['sku'], $row['name'], $row['price'], $row['attr']);
                    $i++;
                }
            } else {
                $response[0] = "connection failed.";
            }
            return $response;
        }
        public function getSku($skuNumber){
            $response = array();
            $sql = $this->conn->prepare("SELECT COUNT(*) AS count FROM products WHERE sku = ?");
            $sku = $skuNumber;
            $sql->bind_param('s', $sku);
            $sql->execute();
            $result = $sql->get_result();
            while($row = $result->fetch_assoc()){
                $response[0] = array($row['count']);
            }
            return $response;
        }
    }
?>