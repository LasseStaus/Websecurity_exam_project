<?php
session_start();
if (!isset($_SESSION)) {
    echo  $_SESSION['user_uuid'];
}
if (!isset($_SESSION['user_uuid'])) {
    header('Location: /login');
    exit();
}
//DATABASE

$tz = 'Europe/London';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
$currentDate = $dt->format('F j Y, H:i');



try {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/db/peberString.php');
    $encryptedMessage = openssl_encrypt($_POST['post_message'], $encrypt_algo, $key, OPENSSL_RAW_DATA, $iv);
    require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
    $q = $db->prepare("INSERT INTO `posts` VALUES ( :post_id, :user_uuid, :post_creator_firstname, :post_creator_lastname, :post_timestamp, :post_message, :post_iv)");
    $q->bindValue(':post_id', bin2hex(random_bytes(16)));
    $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
    $q->bindValue(':post_creator_firstname', $_SESSION['user_firstname']);
    $q->bindValue(':post_creator_lastname', $_SESSION['user_lastname']);
    $q->bindValue(':post_timestamp', $currentDate);
    $q->bindValue(':post_message',  base64_encode($encryptedMessage));
    $q->bindValue(':post_iv',  base64_encode($iv));

    $q->execute();
    if (!$q->rowCount()) {
        echo 'vi er her', $_SESSION['user_uuid'];

        exit;
    }
    header('Location: /index');
    exit();
} catch (PDOException $ex) {

    /*   $ex_code =  $ex->getCode();
  if ($ex_code == "23000") {
    $error_message = 'The email you entered is already in use.';
    header("Location: /signup/error/$error_message");
    exit();
  } */
    echo $ex;
}
