<?php

$user_id = $_POST['user_uuid'];

// ########### VALIDATION ######################

if (!is_csrf_valid() == true) {
    $error_message = "You can't hack signup. as";
    header("Location: /404");
    exit();
}

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['admin_user_uuid'])) {
    header('Location: /admin-login');
    exit();
}

// ########### UPDATE user status (delete) ##############

require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');

if ($_POST['product_status'] == 1) {

    try {
        $q = $db->prepare("UPDATE products SET product_status = 0 WHERE product_id = :product_id AND product_status = :product_status");
        $q->bindValue(':product_id', $_POST['product_id']);
        $q->bindValue(':product_status', 1);
        $q->execute();

        header("Location: /admin/show_user_products/$user_id");
        exit();
    } catch (PDOException $ex) {
        echo 'Oops, something went wrong';
    };
} else {
    try {
        $q = $db->prepare("UPDATE products SET product_status = 1 WHERE product_id = :product_id AND product_status = :product_status");
        $q->bindValue(':product_id', $_POST['product_id']);
        $q->bindValue(':product_status', 0);
        $q->execute();

        header("Location: /admin/show_user_products/$user_id");
        exit();
    } catch (PDOException $ex) {
        echo 'Oops, something went wrong';
    };
}
