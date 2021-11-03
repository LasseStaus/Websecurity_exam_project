<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_top.php');
session_start();
?>
<main>
  <canvas id="svgBlob"></canvas>
  <div class="position">
    <form action="/login" method="POST" onsubmit="return validate()" class="container">
      <div class="centering-wrapper">
        <div class="section1 text-center">
          <div class="primary-header">Welcome back!</div>
          <div class="secondary-header">We're so excited to see you again!</div>
          <div class="input-position">
            <?php
            require_once('./components/component_errormsg.php');
            require_once('./components/component_succcessmsg.php');

            ?>
            <input name="csrf" type="hidden" value="<?= set_csrf() ?>">

            <div class="form-group">
              <h5 class="input-placeholder" id="email-txt">Email<span class="error-message" id="email-error"></span></h5>
              <input onclick="clear_validate_error()" data-validate="email" type="email" name="user_email" class="form-style" id="logemail" autocomplete="on" style="margin-bottom: 20px;">

              <i class="input-icon uil uil-at"></i>
            </div>
            <div class="form-group">
              <h5 class="input-placeholder" id="pword-txt">Password<span class="error-message" id="password-error"></span></h5>
              <input onclick="clear_validate_error()" maxlength="50" data-validate="str" data-min="8" data-max="50" type="password" name="user_password" class="form-style" id="logpass" autocomplete="on">
              <i class="input-icon uil uil-lock-alt"></i>
            </div>
    </form>
  </div>

  <div class="password-container"><a href="#" class="link">Forgot your password?</a> <a href="/signup" class="link">Register new account?</a></div>
  <div class="btn-position">


    <input class="btn" type="submit" value="submit">
  </div>
  </div>

  <div class="qr-login">
    <div class="qr-container">
      <img class="logo" src="/assets/svg/discord_logo-freelogovectors.net_.svg" />

    </div>
    <div class="qr-pheader">Discord</div>
    <div class="qr-sheader">Join the community <strong>use our app </strong>to log in instantly.</div>
  </div>
  </div>
  </form>
  </div>


</main>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_bottom.php');
?>