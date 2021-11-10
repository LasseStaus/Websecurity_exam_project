<?php

if (!isset($_SESSION)) {

  session_start();
}
//TODO LASSE SET VALIDATION FOR EMPTY EMAIL AND OTHER STUFF


if (!isset($_POST['user_firstname'])) {
  header('Location: /account-edit');
  exit();
}

if (!isset($_POST['user_lastname'])) {
  header('Location: /account-edit');
  exit();
}

if (!isset($_POST['user_email'])) {
  header('Location: /account-edit');
  exit();
}

if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
  header('Location: /account-edit');
  exit();
}
if (!preg_match('/^[0-9]{8}+$/', $_POST['user_phone'])) {

  header("Location: /account-edit");
  exit();
}




try {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
  $q = $db->prepare('UPDATE users SET user_firstname = :user_firstname, user_lastname = :user_lastname, user_email = :user_email,
                                      user_phone = :user_phone
                                      WHERE user_uuid = :user_uuid');
  $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
  $q->bindValue(':user_firstname', $_POST['user_firstname']);
  $q->bindValue(':user_lastname', $_POST['user_lastname']);
  $q->bindValue(':user_email', $_POST['user_email']);
  $q->bindValue(':user_phone', $_POST['user_phone']);
  $q->execute();

  if (!$q->rowCount()) {
    echo 'soemthing went wrong';
    exit;
  }

  header("Location: /account-edit/my-user-information");
} catch (PDOException $ex) {
  echo $ex;
}
