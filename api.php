<?php

include_once 'database.php';
include_once 'todos.php';
$database = new Database();
$db = $database->getConnection();
$item = new todos($db);

$data = file_get_contents('php://input');
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "GET":
        $records = $item->getToDos();
        $itemCount = $records->num_rows;
        if($itemCount > 0){
            $toDoArray = array();
            while ($row = $records->fetch_assoc())
            {
                array_push($toDoArray, $row);
            }
            echo json_encode($toDoArray);
        }
        else{
            http_response_code(204);

        }
        break;

    case "POST":
        $decoded_data = json_decode($data, true);
        $item->title = $decoded_data["title"];
        $item->completed = $decoded_data["completed"];
        if($item->createToDo()){
            echo $data;
        } else{
            echo 'Task could not be created.';
        }
        break;

    case "PUT":
        $decoded_data = json_decode($data, true);
        $item->id = $decoded_data["id"];
        $item->title = $decoded_data["title"];
        $item->completed = $decoded_data["completed"];
        if($item->updateToDo()){
            echo $data;
        } else{
            echo 'Task could not be created.';
        }
        break;

    case "DELETE":
        $link = $_SERVER['REQUEST_URI'];
        $getId = substr($link, 17);
        $item->id = $getId;
        if($item->deleteToDo()){
            echo 'ToDo deleted';
        } else{
            echo 'Data could not be deleted';
        }
        break;
}

?>