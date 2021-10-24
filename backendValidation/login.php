<?php

if (

    empty($_POST['user_email']) ||
    empty($_POST['user_password'])

) {
    $error_message = "Please fill in the form";
    header("Location: /login/error/$error_message");
    exit();
}

if (
    strlen($_POST['user_email']) < 1 ||
    strlen($_POST['user_email']) > 50
) {
    $error_message = "Please fill in email";
    header("Location: /login/error/$error_message");
    exit();
}

if (!isset($_POST['user_email'])) {
    $error_message = "Please fill in email";
    header("Location: /login/error/$error_message");
    exit();
}
if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    $error_message = "Email is not valid";
    header("Location: /login/error/$error_message");
    exit();
}

if (!isset($_POST['user_password'])) {
    $error_message = "Please provide a password";
    header("Location: /login/error/$error_message");
    exit();
}

if (
    strlen($_POST['user_password']) < 1
) {
    $error_message = "Please fill in your password";
    header("Location: /login/error/$error_message");
    exit();
}

if (
    strlen($_POST['user_password']) < 8 ||
    strlen($_POST['user_password']) > 50
) {
    $error_message = "Password must be between 8-50 characters";
    header("Location: /login/error/$error_message");
    exit();
}
