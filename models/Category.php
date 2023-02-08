<?php

  class Category {
    // DB Stuff
    private $conn;
    private $table = 'categories';

    // Properties (columns)
    public $id;
    public $name;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Categories 
    public function read() {
      // Create query
      $query = 'SELECT
        id, 
        name,
        created_at
      FROM
        ' . $this->table . '
        ORDER BY 
          created_at DESC';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
    }

    // Get Single Post
    public function read_single() {
      // Create query
      $query = 'SELECT 
              id,
              name,
              created_at
            FROM ' . 
              $this->table . '
            WHERE 
              id = :id';
      
      // Prepare query
      $stmt = $this->conn->prepare($query);

      // Bind parameter
      $stmt->BindParam(":id", $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // Set Properties
      $this->name = $row['name'];
      $this->created_at = $row['created_at'];
    }
  }