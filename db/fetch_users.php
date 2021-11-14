<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['admin_uuid'])) {
    header('Location: /login');
    exit();
}
try {

    require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
    $q = $db->prepare('SELECT * FROM users');
    $q->execute();
    $users = $q->fetchAll();
} catch (PDOException $ex) {
    echo $ex;
}
