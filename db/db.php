<?php

try {
  /**development **/
  /*  $database_user_name = 'root';
  $database_password = 'root'; */

  $database_user_name = 'root';
  $database_password = '';
  $database_connection = 'mysql:host=localhost; dbname=websec_project; charset=utf8mb4';

  /*production
  
  */
  /*   $database_user_name = 'lassxkot_websec';
  $database_password = 'websecproject';
  $database_connection = 'mysql:host=localhost; dbname=lassxkot_websec_project; charset=utf8mb4'; */

  /* $database_password = 'root'; */


  $database_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ];

  $db =  new PDO($database_connection, $database_user_name, $database_password, $database_options);
} catch (Exception $ex) {
  http_response_code(500);
  echo "System under maintainance";
}
