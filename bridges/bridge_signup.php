<?php




if (!isset($_SESSION)) {
  session_start();
}
require('./backendValidation/signup.php');

//DATABASE

require_once('./db/peberString.php');


$salt = bin2hex(openssl_random_pseudo_bytes(50));
$hashed = hash(algo: $algo, data: $_POST['user_password'] . $salt . $peberstring);


try {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
  $q = $db->prepare("INSERT INTO `users` VALUES ( :user_uuid, :user_firstname, :user_lastname, :user_email, :user_password, :user_salt)");
  $q->bindValue(':user_uuid', bin2hex(random_bytes(16)));
  $q->bindValue(':user_firstname', $_POST['user_firstname']);
  $q->bindValue(':user_lastname', $_POST['user_lastname']);
  $q->bindValue(':user_email', $_POST['user_email']);
  $q->bindValue(':user_password', $hashed);
  $q->bindValue(':user_salt', $salt);

  $q->execute();
  if (!$q->rowCount()) {
    header('Location: /signup');
    exit();
  }
  header("Location: /login");
  echo 'her';
  exit;
} catch (PDOException $ex) {

  /*   $ex_code =  $ex->getCode();
  if ($ex_code == "23000") {
    $error_message = 'The email you entered is already in use.';
    header("Location: /signup/error/$error_message");
    exit();
  } */
  echo $ex;
}
