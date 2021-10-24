<?php

try {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
    $q = $db->prepare('SELECT * FROM posts ');
    $q->execute();
    $posts = $q->fetchAll();
} catch (PDOException $ex) {
    echo $ex;
}
