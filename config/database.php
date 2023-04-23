<?php
class Database {
    private $conn;
    private $db_select;

    public function __construct() {
        define('LOCALHOST','localhost');
        define('DB_USERNAME','root');
        define('DB_PASSWORD','');
        define('DB_NAME','pplbo');
        $this->conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());  //Database connection
        $this->db_select = mysqli_select_db($this->conn, DB_NAME) or die(mysqli_error());  //Database selection
    }

    public function getConnection() {
        return $this->conn;
    }
}
class BaseUrl {
    public $base_url = "http://localhost/pplbo/";

    public function getBaseUrl() {
        return $this->base_url;
    }
}
?>