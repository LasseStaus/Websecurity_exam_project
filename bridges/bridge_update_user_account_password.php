<?php

if (!isset($_SESSION)) {

  session_start();
}
//TODO LASSE SET VALIDATION FOR EMPTY EMAIL AND OTHER STUFF


if (!isset($_POST['user_password'])) {
  $error_message = "Please enter a new password";
  header("Location: /account-edit/change-password/$error_message");
  exit();
}

if ($_POST['user_password'] != $_POST['user_confirm_password']) {
  $error_message = "Password doesn't match";
  header("Location: /account-edit/change-password/$error_message");
  exit();
}

if (
  strlen($_POST['user_password']) < 8 ||
  strlen($_POST['user_password']) > 50
) {
  $error_message = "Password must be between 8 and 50 characters ";
  header("Location: /account-edit/change-password/$error_message");
  exit();
}
if (
  strlen($_POST['user_confirm_password']) < 8 ||
  strlen($_POST['user_confirm_password']) > 50
) {
  $error_message = "Password must be between 8 and 50 characters ";
  header("Location: /account-edit/change-password/$error_message");
  exit();
}

require_once('./db/globals.php');
$salt = bin2hex(openssl_random_pseudo_bytes(50));
$hashed = hash($algo, $_POST['user_password'] . $salt . $peberstring);

try {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
  $q = $db->prepare('UPDATE users SET user_password = :user_password, user_salt = :user_salt WHERE user_uuid = :user_uuid');
  $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
  $q->bindValue(':user_password', $hashed);
  $q->bindValue(':user_salt', $salt);
  $q->execute();

  if (!$q->rowCount()) {
    echo 'soemthing went wrong';
    exit;
  }

  $update_message = "You have changed your password";
  header("Location: /account-edit/change-password/$update_message");
} catch (PDOException $ex) {
  echo $ex;
}
