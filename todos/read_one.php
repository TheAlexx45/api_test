<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../objects/todos.php';

$database = new Database();
$db = $database->getConnection();

$todos = new Todos($db);

$todos->id = isset($_GET['id']) ? $_GET['id'] : die();

$todos->readOne();

if($todos->title!=null){
    $todos_arr = array(
        "id" =>  $todos->id,
        "title" => $todos->title,
        "description" => $todos->description
    );

    http_response_code(200);
    
    echo json_encode($todos_arr);
} else{

    http_response_code(404);
    echo json_encode(array("message" => "La todos n'existe pas"));
  }
?>
