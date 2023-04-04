<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    require("Product.php");

    
    $servername = "localhost";
    $username = "id20517890_root";
    $password = "^aKUmc3x7(P6aS)";
    $dbname = "id20517890_scandiweb";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $data = json_decode(file_get_contents("php://input"));
    $response = array();

    // select all for first page
    if($data -> request == 1){
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
    
        $i = 0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $response[$i] = array($row['id'], $row['sku'], $row['name'], $row['price'], $row['attr']);
                $i++;
            }
        } else {
            $response[0] = "connection failed.";
        }
    }
    //insert into for second page
    else if($data -> request == 2){
        $product = new Product($data->sku, $data->name, $data->price);
        if($data -> selectedOption == "dvd"){
            $product->set_attr($data->size."MB");
        }
        else if($data -> selectedOption == "book"){
            $product->set_attr($data->weight."KG");
        }
        else if($data -> selectedOption == "furniture"){
            $product->set_furni_attr($data->height, $data->width, $data->length."M");
        }
        $response[0] = array($product->get_sku(),$product->get_name(), $product->get_price(),$product->get_attr());
        $sql = $conn->prepare("INSERT INTO products (sku, name, price, attr) VALUES (?, ?, ?, ?)");
        $sku = $product->get_sku();
        $name = $product->get_name();
        $price = $product->get_price();
        $attr = $product->get_attr();
        $sql->bind_param('ssss',$sku,$name,$price,$attr);
        $sql->execute();
    }
    //mass delete
    else if($data -> request == 3){
        $sql = $conn->prepare("DELETE FROM products WHERE id = ?");
        $ids = $data->idArray;
        $sql->bind_param('i', $id);
        for ($i = 0; $i < count($ids); $i++) {
            $id = $ids[$i];
            $sql->execute();
        }
        if ($sql->error) {
            $response[0] = $sql->error;
        } else {
            $response[0] = "Success";
        }
    }
    //checking sku
    else if($data -> request == 4){
        $sql = $conn->prepare("SELECT COUNT(*) AS count FROM products WHERE sku = ?");
        $sku = $data -> sku;
        $sql->bind_param('s', $sku);
        $sql->execute();
        $result = $sql->get_result();
        while($row = $result->fetch_assoc()){
            $response[0] = array($row['count']);
        }
    }
    echo json_encode($response);
    $conn->close();
?>