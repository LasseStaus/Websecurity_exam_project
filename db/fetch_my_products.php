<?php
try {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
    $q = $db->prepare('SELECT * FROM products WHERE user_uuid = :user_uuid');
    $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
    $q->execute();
    $user_products = $q->fetchAll();
} catch (PDOException $ex) {
    echo $ex;
}
