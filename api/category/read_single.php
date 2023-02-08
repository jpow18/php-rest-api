<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantiate DB & Connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $category = new Category($db);

  // Category read single category
  $category->read_single();

  // Create an array
  $cat_arr = array(
    'name' => $this->name,
    'created_at' => $this->created_at
  );

  // Print JSON
  print_r(json_encode($cat_arr));
  
?>