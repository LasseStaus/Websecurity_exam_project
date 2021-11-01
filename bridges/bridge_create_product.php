<?php
session_start();

if (!isset($_SESSION['user_uuid'])) {
    header('Location: /login');
    exit();
}


if (
    !empty($_POST['product_description'])
) {


    //DATABASE

    $tz = 'Europe/Copenhagen';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
    $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
    $currentDate = $dt->format('F j Y, H:i:s');

    try {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/db/peberString.php');
        $encryptedDescription = openssl_encrypt($_POST['product_description'], $encrypt_algo, $key, OPENSSL_RAW_DATA, $iv);
        require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
        $q = $db->prepare("INSERT INTO `products` VALUES ( :product_id, :user_uuid, :product_title, :product_description, :product_image, :product_timestamp, :product_price, :product_category, :product_iv)");
        $q->bindValue(':product_id', bin2hex(random_bytes(16)));
        $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
        $q->bindValue(':product_title', $_POST['product_title']);
        $q->bindValue(':product_description', $encryptedDescription);
        $q->bindValue(':product_image', 'defaultimg');
        $q->bindValue(':product_timestamp', $currentDate);
        $q->bindValue(':product_price', $_POST['product_price']);
        $q->bindValue(':product_category', $_POST['product_category']);
        $q->bindValue(':product_iv',  base64_encode($iv));
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
