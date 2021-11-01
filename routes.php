<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/router.php');
/* preloader
get('/', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/index.php');
}); */

get('/', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_index.php');
});


get('/index', function () {

  require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_index.php');
});


// #########################################################
// ################### LOGIN ###############################
// #########################################################

get('/login', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_login.php');
});

get('/login/error/:message', 'render_login_error');
function render_login_error($message)
{
  $error_message = $message;
  require_once(__DIR__ . '/views_login/view_login.php');
  exit();
}
get('/login/success/:message', 'render_login_success');
function render_login_success($success_message)
{
  $success_message = $success_message;
  require_once(__DIR__ . '/views_login/view_login.php');
  exit();
}
post('/login', function () {

  // check if token is valid

  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_login.php');
});



// #########################################################
// ################### SIGNUP ##############################
// #########################################################

get('/signup', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_signup.php');
});

get('/signup/error/:message', 'render_signup_error');
function render_signup_error($message)
{
  $error_message = $message;
  require_once(__DIR__ . '/views_login/view_signup.php');
  exit();
}
post('/signup', function () {

  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_signup.php');
});

get('/signup_welcome_email/:user_confirmation_key/:email_recipient', 'serve_signup_confirmation_email');
function serve_signup_confirmation_email($user_confirmation_key, $recipient)
{
  $user_confirmation_key = $user_confirmation_key;
  $recipient = $recipient;
  require_once(__DIR__ . '/apis/api_signup_email.php');
  exit();
}


// from email 
get('/confirm/:user_confirmation_key', function ($user_confirmation_key) {
  $user_confirmation_key = $user_confirmation_key;
  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_confirm_user.php');
});


// #########################################################
// ################### Comments ###############################
// #########################################################

post('/create-post', function () {


  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_create_comment.php');
});




// #########################################################
// ################### Products ###############################
// #########################################################

get('/single-product/:product_id', function ($product_id) {

  $product_id = $product_id;
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_single_product.php');
});



get('/create-product', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_create_product.php');
});

post('/create-new-product/:user_uuid', function ($id) {

  $id = $id;
  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_create_product.php');
});


// #########################################################
// ################### LOST PASSWORD ######################
// #########################################################


get('/lost-password', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_new_password.php');
});
get('/lost-password/success/:message', 'render_success_message');
function render_success_message($success_message)
{
  $success_message = $success_message;
  require_once(__DIR__ . '/views/view_new_password.php');
  exit();
};

get('/create-new-password/:user_email', function ($user_email) {
  $user_email = $user_email;
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_create_new_password.php');
});
get('/create-new-password/error/:message', function ($error_message) {
  $error_message = $error_message;

  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_create_new_password.php');
});

post('/create-new-password', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_create_new_password.php');
});




// #########################################################
// #################### SEARCH #############################
// #########################################################


post('/search', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/apis/api_search.php');
});



// #########################################################
// ################# EDIT USER ACCOUNT #####################
// #########################################################



post('/update-user-account', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_update_user_account.php');
});

post('/upload-profile-image', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_upload_profile_image.php');
});
post('/lost-password-mail', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_send_lost_password_mail.php');
});

// #########################################################
// ################### LOGOUT ##############################
// #########################################################
get('/logout', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_logout.php');
});

// For GET or POST
any('/404', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_404.php');
});
