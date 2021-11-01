<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!is_csrf_valid() == true) {
    $error_message = "You can't hack signup. as";
    header("Location: /signup/error/$error_message");
    exit();
}

if (!isset($_POST['user_email'])) {
    $error_message = "Please provide an Email";
    header("Location: /signup/error/$error_message");
    exit();
}


if (!isset($_POST['user_password'])) {
    $error_message = "Please provide a Password";
    header("Location: /signup/error/$error_message");
    exit();
}

if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {

    $error_message = "Invalid email format";
    header("Location: /signup/error/$error_message");
    exit();
}
if (
    strlen($_POST['user_password']) < 8 ||
    strlen($_POST['user_password']) > 50
) {
    $error_message = "Password must be between 8 and 50 characters";
    header("Location: /signup/error/$error_message");
    exit();
}
