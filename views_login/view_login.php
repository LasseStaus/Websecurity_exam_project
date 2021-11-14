<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_top.php');
session_start();
?>
<main>
  <div class="flex_container">

    <div class="image_login_container">
      <img src="/assets/imgs/shopping.svg" alt="background image">
    </div>

    <div class="login_signup_form">
      <form action="/login" method="POST" onsubmit="return validate()">
        <div class="centering-wrapper">
          <div class="section1 text-center">
            <div class="primary-header">
              <h1>Sign in</h1>
            </div>
            <div class="secondary-header">Sign in to your account</div>
            <div class="input-position">
              <?php
              require_once('./components/component_errormsg.php');
              require_once('./components/component_succcessmsg.php');

              ?>
              <input name="csrf" type="hidden" value="<?= set_csrf() ?>">

              <div class="form-group">
                <h5 id="email-txt">Email</h5>
                <input onclick="clear_validate_error()" data-validate="email" type="email" name="user_email" id="logemail" autocomplete="on">
                <span id="email-error">Please provide a valid email</span>
                <i class="input-icon uil uil-at"></i>
              </div>
              <div class="form-group ">
                <h5 id="pword-txt">Password</h5>
                <input onclick="clear_validate_error()" maxlength="50" data-validate="str" data-min="8" data-max="50" type="password" name="user_password" id="logpass" autocomplete="on">
                <span id="password-error">Please provide a valid password | 8-50 characters</span>
                <i class="input-icon uil uil-lock-alt"></i>
              </div>
      </form>

      <div class="password-container"><a href="#" class="link2">Forgot your password?</a> <a href="/admin-login" class="link2">Login as admin</a></div>
      <div class="btn-position">
        <button type="submit" class="button large">sign in</button>
        <div>
          <p>Don't have an account?</p> <a href="/signup" class="link">sign up</a>
        </div>
      </div>
    </div>

  </div>
  </form>
  </div>
  </div>

</main>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_bottom.php');
?>