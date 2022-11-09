<?php

class todos
{

    private $db;
    private $db_table = "todos";
    public $id;
    public $title;
    public $completed;
    public $result;

    public function __construct($db)
    {
        $this->db = $db;
    }

// GET ALL
    public function getToDos()
    {
        $sqlQuery = "SELECT id, title, completed FROM " . $this->db_table . "";
        $this->result = $this->db->query($sqlQuery);
        return $this->result;
    }

    // CREATE
    public function createToDo(){
        $sqlQuery = "INSERT INTO
        " . $this->db_table . " (title, completed) values (
        '". $this->title."', '".$this->completed."')";
        $this->db->query($sqlQuery);

        if($this->db->affected_rows > 0){
            return true;
        }
        return false;
    }

    // UPDATE
    public function updateToDo(){

        $sqlQuery = "UPDATE todos SET
        title = '". $this->title. "',
        completed = '" .$this->completed. "'
        WHERE id = '" .$this->id."' ";

        $this->db->query($sqlQuery);
        if($this->db->affected_rows > 0){
            return true;
        }
        return false;
    }

// DELETE
    function deleteToDo(){
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ".$this->id;
        $this->db->query($sqlQuery);
        if($this->db->affected_rows > 0){
            return true;
        }
        return false;
    }
}
?>