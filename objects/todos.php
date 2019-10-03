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
}
