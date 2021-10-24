<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_top.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_body.php');
require_once('./components/component_errormsg.php');
require_once('./components/component_succcessmsg.php');
?>
<div class="form-wrapper">
  <h2>Signup</h2>
  <form id="signup-form" method="POST" action="/signup">
    <label for=" user_name"> First name <i class="fas fa-user"></i></label>
    <input type="text" name="user_firstname" data-validate="str" data-min="2" data-max="50">
    <label for="user_last_name"> Last name<i class="fas fa-user"></i></label>
    <input type="text" name="user_lastname" data-validate="str" data-min="2" data-max="50">
    <label for="user_email"> Email <i class="fas fa-envelope"></i></label>
    <input type="text" name="user_email" data-validate="email" data-min="" data-max="">
    <label for="user_password">Password<i class="fas fa-lock"></i></i></label>
    <input type="password" name="user_password" data-validate="str" data-min="4" data-max="16">
    <label for="user_confirm_password">Confirm Password<i class="fas fa-lock"></i></i></label>
    <input type="password" name="user_confirm_password" data-match-name="user_password" data-validate="match" data-min="4" data-max="16">
    <button>Signup</button>
    <div class="swap-login">Already have an accou_loginnt? <a href="/login">Login here!</a></div>
  </form>
</div>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_bottom.php');
