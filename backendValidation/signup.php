<?php

/* echo "empty", empty($_POST['user_firstname']);
echo '<br>';
echo "isset", !isset($_POST['user_firstname']);


var_dump(isset($_POST['user_firstname']));
exit; */
if (
    empty($_POST['user_firstname']) ||
    empty($_POST['user_lastname']) ||
    empty($_POST['user_email']) ||
    empty($_POST['user_password']) ||
    empty($_POST['user_confirm_password'])
) {
    $error_message = "Please fill in the form";
    header("Location: /signup/error/$error_message");
    exit();
}

if (!isset($_POST['user_firstname'])) {
    /*  echo 'missing firstname';
    exit; */
    $error_message = "Please provide a first name";
    header("Location: /signup/error/$error_message");
    exit();
}

if (!isset($_POST['user_lastname'])) {

    $error_message = "Please provide a last name";
    header("Location: /signup/error/$error_message");
    exit();
}

if (!isset($_POST['user_email'])) {
    $error_message = "Please provide an Email";
    header("Location: /signup/error/$error_message");
    exit();
}


/* if (!isset($_POST['user_phone'])) {
    $error_message = "Please provide a phone number";
    header("Location: /signup/error/$error_message");
    exit();
}

 */
if (!isset($_POST['user_password'])) {
    $error_message = "Please provide a Password";
    header("Location: /signup/error/$error_message");
    exit();
}

if (!isset($_POST['user_confirm_password'])) {
    $error_message = "Please fill in Confirm password";
    header("Location: /signup/error/$error_message");
    exit();
}
if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    header('Location: /signup');
    exit();
}
/* if (!preg_match('/^[0-9]{8}+$/', $_POST['user_phone'])) {
    $error_message = 'Phone number cannot start with a 0';
    header("Location: /signup/error/$error_message");
    exit();
}

if (
    strlen($_POST['user_phone']) != 8
) {
    $error_message = "Phone number must be 8 digits. ";
    header("Location: /signup/error/$error_message");
    exit();
} */

if (
    strlen($_POST['user_confirm_password']) < 8 ||
    strlen($_POST['user_confirm_password']) > 50
) {
    $error_message = "Password must be between 8 and 50 characters";
    header("Location: /signup/error/$error_message");
    exit();
}
if ($_POST['user_password'] != $_POST['user_confirm_password']) {
    $error_message = 'Password and Password confirm dont match';
    header("Location: /signup/error/$error_message");
    exit();
}
