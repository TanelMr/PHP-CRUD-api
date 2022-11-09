<?php

include_once 'database.php';
include_once 'todos.php';
$database = new Database();
$db = $database->getConnection();
$item = new todos($db);
$data = file_get_contents('php://input');
$decoded_data = json_decode($data, true);
$item->id = $decoded_data["id"];
$item->title = $decoded_data["title"];
$item->completed = $decoded_data["completed"];
if($item->updateToDo()){
    echo $data;
} else{
    echo 'Task could not be created.';
}
?>