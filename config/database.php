<?php
class Database{

    private $host = "localhost";
    private $db_name = "api_db";
    private $username = "root";
    private $password = "root13051996om";
    public $connexion;

    public function getConnection(){

        $this->connexion = null;

        try{
            $this->connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->connexion->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->connexion;
    }
}
?>
