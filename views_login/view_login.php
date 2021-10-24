<?php
//require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_top.php');
//require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_body.php');
require_once('./components/component_errormsg.php');
require_once('./components/component_succcessmsg.php');


?>

<!-- <div class="form-wrapper">
  <h2>Login</h2>
  <form id="login-form" action="/login" method="POST" onsubmit="return validate()">
    <label for="user_email">Email<i class="fas fa-user"></i></label>
    <input name="user_email" type="text" data-validate="email">
    <label for="user_password">Password <i class="fas fa-lock"></i></label>
    <input name="user_password" maxlength="50" data-validate="str" data-min="2" data-max="50" type="password">
    <button for="login-form" type="submit">
      login
    </button>
    <div class="button-container">
      <a class="button" href="/lost-password" class="forgotpw">Forgot your password?</a>

      <a class="button blue" href="/signup">Sign up here!</a>
    </div>
  </form>
</div> -->
 

 <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/login.php');?>


<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_bottom.php');
?>