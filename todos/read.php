<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/todos.php';

$database = new Database();
$db = $database->getConnection();

$todos = new Todos($db);

$stmt = $todos->read();
$num = $stmt->rowCount();

if($num>0){

    $todos_arr=array();
    $todos_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $todos_item=array(
            "id" => $id,
            "title" => $title,
            "description" => html_entity_decode($description),
        );

        array_push($todos_arr["records"], $todos_item);
    }

    http_response_code(200);

    echo json_encode($todos_arr);
} else{

    http_response_code(404);

    echo json_encode( array("message" => "Pas de todos trouvé") );
}
