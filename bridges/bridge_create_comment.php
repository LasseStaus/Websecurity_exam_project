<?php
session_start();
if (!isset($_SESSION)) {
    echo  $_SESSION['user_uuid'];
}
if (!isset($_SESSION['user_uuid'])) {
    header('Location: /login');
    exit();
}


if (
    !empty($_POST['comment_message'])
) {

    //DATABASE
    $tz = 'Europe/Copenhagen';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
    $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
    $currentDate = $dt->format('F j Y, H:i:s');

    try {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/db/globals.php');
        $encryptedMessage = openssl_encrypt($_POST['comment_message'], $encrypt_algo, $key, OPENSSL_RAW_DATA, $iv);
        require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
        $q = $db->prepare("INSERT INTO `comments` VALUES ( :comment_id, :user_uuid, :comment_timestamp, :comment_message, :comment_iv)");
        $q->bindValue(':comment_id', bin2hex(random_bytes(16)));
        $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
        $q->bindValue(':comment_timestamp', $currentDate);
        $q->bindValue(':comment_message',  base64_encode($encryptedMessage));
        $q->bindValue(':comment_iv',  base64_encode($iv));

        $q->execute();
        if (!$q->rowCount()) {
            echo 'vi er her', $_SESSION['user_uuid'];

            exit;
        }
        header('Location: /index');
        exit();
    } catch (PDOException $ex) {
        echo $ex;
    }
} else {
    header('Location: /index');
    exit();
}
