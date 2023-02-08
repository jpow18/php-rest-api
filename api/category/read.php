<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once "../../config/Database.php";
  include_once "../../models/Category.php";

  // Instantiate DB and connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate a new category object
  $category = new Category($db);

  // Category read query
  $results = $category->read();

  // Get rowcount to check if anything returned
  $num = $results->rowCount();

  // Check if any categories
  if ($num > 0) {
    // Category array
    $cat_arr = array();
    $cat_arr['data'] = array();

    while($row = $results->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $cat_item = array(
        'id' => $id,
        'name' => $name
      );

      // Push to "data"
      array_push($cat_arr['data'], $cat_item);
    }

    echo json_encode($cat_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }