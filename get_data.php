<?php

class DataBase {

    private $servername = "localhost";
    private $username = "root";
    private $password = "MDPR00t?";
    private $database = "ajax_php";
    private $conn;

    public function __construct() {
        try {
            $this -> conn = new PDO("mysql:host=$this->servername; database=$this->database, $this->username, $this->password");
            $this -> conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "La connexion a échoué :".$e -> getMessage();
        }
    }

    public function getDataFromTable () {
        $data = array();
        try {
            $sql = "SELECT name, email FROM users";
            $stmt = $this -> conn -> query($sql);

            while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des données : ".$e -> getMessage();
        }
        return json_encode($data);
    }
    public function closeConnection() {
        $this -> conn = null;
    }
}

$db = new DataBase();
$data = $db -> getDataFromTable();
echo $data;
$db -> closeConnection();

?>