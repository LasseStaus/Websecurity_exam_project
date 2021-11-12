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
    !empty($_POST['reply_body'])
) {

    //DATABASE
    $tz = 'Europe/Copenhagen';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
    $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
    $currentDate = $dt->format('F j Y, H:i:s');

    $product_id = $_POST['product_id'];
    //$comment_id = $_POST['comment_id'];
   /*  var_dump($comment_id);
    exit(); */
    

    try {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/db/globals.php');
        $encryptedReply = openssl_encrypt($_POST['reply_body'], $encrypt_algo, $key, OPENSSL_RAW_DATA, $iv);
        require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
        require_once($_SERVER['DOCUMENT_ROOT'] . '/db/fetch_comments.php');
        $q = $db->prepare("INSERT INTO `replies` VALUES ( :reply_id, :reply_iv, :user_uuid, :comment_id, :reply_body, :created_at, :updated_at )");
        $q->bindValue(':reply_id', bin2hex(random_bytes(16)));
        $q->bindValue(':reply_iv',  base64_encode($iv));
        $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
        $q->bindValue(':comment_id', $_POST['comment_id']);
        $q->bindValue(':reply_body',  base64_encode($encryptedReply));
        $q->bindValue(':created_at', $currentDate);
        $q->bindValue(':updated_at', $currentDate);
       
       
       

        $q->execute();
        if (!$q->rowCount()) {
            echo 'vi er her', $_SESSION['user_uuid'];

            exit;
        }
         header("Location: /single-product/$product_id");
        exit(); 
    } catch (PDOException $ex) {
        echo $ex;
    }
} else {
   /*  header("Location: /index");
    exit(); */
}
