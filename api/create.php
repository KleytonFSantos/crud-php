<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/db.php';
    include_once '../database/clientes.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new Client($db);
    $data = json_decode(file_get_contents("php://input"));
    $item->nome = $data->nome;
    $item->email = $data->email;
    
    if($item->createClient()){
        echo 'Employee created successfully.';
    } else{
        echo 'Employee could not be created.';
    }
?>