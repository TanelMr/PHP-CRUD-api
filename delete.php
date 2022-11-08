<?php

include_once 'database.php';
include_once 'todos.php';

$database = new Database();
$db = $database->getConnection();
$item = new todos($db);

$item->id = isset($_GET['id']) ? $_GET['id'] : die();

if($item->deleteToDo()){
    echo json_encode("ToDo deleted.");
} else{
    echo json_encode("Data could not be deleted");
}
?>
