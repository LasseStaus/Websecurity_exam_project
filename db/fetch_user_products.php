<?php


try {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
    $q = $db->prepare("SELECT * FROM products WHERE user_uuid = '$user_id'");
    $q->execute();
    $products = $q->fetchAll();
} catch (PDOException $ex) {
    echo $ex;
}
