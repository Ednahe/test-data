<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

header('Content-Type: application/json');

class DataBase {

    private $servername = "localhost";
    private $username = "root";
    private $password = "MDPR00t?";
    private $database = "ajax_php";
    private $conn;

    public function __construct() {
        try {
            $this -> conn = new PDO("mysql:host=$this->servername; dbname=$this->database, $this->username, $this->password");
            $this -> conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->sendError("La connexion a échoué : ".$e->getMessage());
            exit();
        }
    }

    public function getDataFromTable () {
        $data = array();
        try {
           // $sql = "SELECT * FROM users";
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

    private function sendError($message) {
        echo json_encode(array("error" => $message));
    }
}

$db = new DataBase();
$data = $db -> getDataFromTable();
echo $data;
$db -> closeConnection();

// $response = array(
//     "status" => "success",
//     "message" => "Test data",
//     "data" => array(
//         array("name" => "Patrick", "email" => "patrick@gmail.com"),
//         array("name" => "Bob", "email" => "bob@hotmail.fr")
//     )
// );

// echo json_encode($response);

?>