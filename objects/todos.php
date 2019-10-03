<?php
class Todos{

    private $connexion;
    private $table_name = "todos";

    public $id;
    public $title;
    public $description;

    public function __construct($db){
        $this->connexion = $db;
    }

  function read(){

      $query = ("SELECT * FROM todos");
      $stmt = $this->connexion->prepare($query);
      $stmt->execute();

      return $stmt;
  }

  function create(){

    $query = ("INSERT INTO todos SET title=:title, description=:description");
    $stmt = $this->connexion->prepare($query);

    $this->title=htmlspecialchars(strip_tags($this->title));
    $this->description=htmlspecialchars(strip_tags($this->description));

    $stmt->bindParam(":title", $this->title);
    $stmt->bindParam(":description", $this->description);

    if($stmt->execute()){
        return true;
    }

    return false;

  }
}
