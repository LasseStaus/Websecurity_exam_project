<?php

try {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
    $q = $db->prepare("SELECT * FROM comments WHERE product_id = '$product_id' ");
    $q->execute();
    $comments = $q->fetchAll();
} catch (PDOException $ex) {
    echo $ex;
}
