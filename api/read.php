<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/db.php';
    include_once '../database/clientes.php';

    $database = new Database();
    $db = $database->getConnection();
    $items = new Client($db);
    $stmt = $items->getClient();
    $itemCount = $stmt->rowCount();

    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $clienteArr = array();
        $clienteArr["body"] = array();
        $clienteArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "nome" => $nome,
                "email" => $email
            );
            array_push($clienteArr["body"], $e);
        }
        echo json_encode($clienteArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>