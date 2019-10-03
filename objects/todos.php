<?php
class Todos{

    private $connexion;

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

  function readOne(){

    $query = ("SELECT * FROM todos WHERE id=? ");

    $stmt = $this->connexion->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->title = $row['title'];
    $this->description = $row['description'];
  }

  function delete(){

    $query = ("DELETE FROM todos WHERE id=? ");

    $stmt = $this->connexion->prepare($query);
    $this->id=htmlspecialchars(strip_tags($this->id));
    $stmt->bindParam(1, $this->id);

    if($stmt->execute()){
        return true;
    }

    return false;
  }
}
