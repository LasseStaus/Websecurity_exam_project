<?php

session_start();

if (!isset($_SESSION['user_uuid'])) {
    header('Location: /login');
    exit();
}

try {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
    $q = $db->prepare('SELECT * FROM products where product_status = 1');
    $q->execute();
    $products = $q->fetchAll();
} catch (PDOException $ex) {
    echo $ex;
}
