<?php

try {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
    $q = $db->prepare('SELECT * FROM comments ');
    $q->execute();
    $comments = $q->fetchAll();
} catch (PDOException $ex) {
    echo $ex;
}
