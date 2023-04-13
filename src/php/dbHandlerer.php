<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    
    require("Dvd.php");
    require("Furniture.php");
    require("Book.php");
    require("ProductManagerImpl.php");

    $servername = "localhost";
    $username = "id20517890_root";
    $password = "^aKUmc3x7(P6aS)";
    $dbname = "id20517890_scandiweb";

    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "scandiweb";

    $data = json_decode(file_get_contents("php://input"));
    $response = array();

    $productManager = new ProductManagerImpl(new mysqli($servername, $username, $password, $dbname));

    // select all for first page
    if($data -> request == 1){
        $response = $productManager->getAllProducts();
    }
    //insert into for second page
    else if($data -> request == 2){
        $product = null;
        if($data -> selectedOption == "dvd"){
            $product = new Dvd($data->sku, $data->name, $data->price);
            $product->set_attr($data->size);
        }
        else if($data -> selectedOption == "book"){
            $product = new Book($data->sku, $data->name, $data->price);
            $product->set_attr($data->weight);
        }
        else if($data -> selectedOption == "furniture"){
            $product = new Furniture($data->sku, $data->name, $data->price);
            $product->set_attr($data->dimensions);
        }
        $response[0] = $productManager->addProduct($product);
    }
    //mass delete
    else if($data -> request == 3){
        $ids = $data->idArray;

        for ($i = 0; $i < count($ids); $i++) {
            $id = $ids[$i];
            $response[0] = $productManager->deleteProduct($id);
        }
    }
    //checking sku
    else if($data -> request == 4){
        $response[0] = $productManager->getSku($data->sku);
    }
    echo json_encode($response);
    $productManager->conn->close();
?>