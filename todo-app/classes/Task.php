<?php

class Task
{
  private $conn;
  private $table = "tasks";
  public $id;
  public $task;
  public $is_completed;
  public $created_at;
  public function __construct($db)
  {
    $this->conn = $db;
  }
  public function create()
  {
    $query = "INSERT INTO {$this->table} (task) VALUES (?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $this->task);
    return $stmt->execute();
  }

  public function read()
  {
    $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
    $result = $this->conn->query($query);
    return $result;
  }

  public function complete($id)
  {
    $query = "UPDATE {$this->table} SET is_completed=1 WHERE id=?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
  }

  public function undo($id)
  {
    $query = "UPDATE {$this->table} SET is_completed=0 WHERE id=?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
  }

  public function delete($id)
  {
    $query = "DELETE FROM {$this->table} WHERE id=?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
  }
}