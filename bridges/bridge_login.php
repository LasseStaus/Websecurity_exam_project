<?php
if (!isset($_SESSION)) {
  session_start();
}
require('./backendValidation/login.php');
require('./db/peberString.php');
try {



  require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
  $q = $db->prepare('SELECT * FROM users WHERE user_email = :user_email');
  $q->bindValue(':user_email', $_POST['user_email']);
  $q->execute();
  $user = $q->fetch();

  $check = hash(algo: $algo, data: $_POST['user_password'] . $user['user_salt'] . $peberstring);

  if ($check !== $user['user_password']) {
    $error_message = "salt does workses";
    header("Location: /login/error/$error_message");
    exit();
  }

  if (!$user) {
    $error_message = "The account you are trying to access does not exist";
    header("Location: /login/error/$error_message");
    exit();
  }

  $_SESSION['user_uuid'] = $user['user_uuid'];
  $_SESSION['user_firstname'] = $user['user_firstname'];
  $_SESSION['user_lastname'] = $user['user_lastname'];
  header('Location: /index');
  exit();
} catch (PDOException $ex) {
  echo $ex;
}
