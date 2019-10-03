<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/todos.php';

$database = new Database();
$db = $database->getConnection();

$todos = new Todos($db);

$data = json_decode(file_get_contents("php://input"));

if( !empty($data->title) && !empty($data->description) ){

    $todos->title = $data->title;
    $todos->description = $data->description;

    if($todos->create()){

        http_response_code(201);
        echo json_encode(array("message" => "La todo a bien été crée"));
    } else{

        http_response_code(503);
        echo json_encode(array("message" => "Erreur"));
    }
} else{

    http_response_code(400);
    echo json_encode(array("message" => "Pas assez d'informations"));
}
?>
