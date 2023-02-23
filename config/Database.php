<?php

  class Database {

    
    // DB Params
    private $host = 'localhost';
    private $port = '5432';
    private $db_name = 'myblog';
    private $username = 'postgres';
    private $password;
    private $conn;

    // Use constructor to set password as it is not
    // constant and so cannot be set above.
    public function __construct() {
      $this->password = getenv('DB_PASSWORD');
    }

    // DB Connect
    public function connect() {
      $this->conn = null;
      $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";

      try {
        $this->conn = new PDO($dsn, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }
      return $this->conn;
    }
  }

?>