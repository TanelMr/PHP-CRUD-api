<?php
include_once 'database.php';
include_once 'todos.php';
$database = new Database();

$db = $database->getConnection();
$items = new todos($db);
$records = $items->getToDos();
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
?>