<?php
class Database {   
    protected $conn;
    public function __construct(){
        if (file_exists(__DIR__ . "/../.env")) {
            $_ENV = parse_ini_file(__DIR__ . "/../.env");
        } else {
             $_ENV = $_ENV ?: getenv();
        }
       
        $host = trim($_ENV['DB_HOST']);
        $port = 14632;
        $user = trim($_ENV['DB_USER']);
        $pass = trim($_ENV['DB_PASSWORD']);
        $db = trim($_ENV['DB_NAME']);
        
        // Correct path for ca.pem inside the Class folder
        $ca = __DIR__ . '/ca.pem';
        
        $this->conn = mysqli_init();

        $this->conn->ssl_set(NULL, NULL, $ca, NULL, NULL);
      
        $this->conn->real_connect($host, $user, $pass, $db, $port, NULL, MYSQLI_CLIENT_SSL);
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}
?>