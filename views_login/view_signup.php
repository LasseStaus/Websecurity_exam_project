<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_top.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_body.php');
require_once('./components/component_errormsg.php');
require_once('./components/component_succcessmsg.php');
?>
<canvas id="svgBlob"></canvas>
<div class="position">
  <form action="/signup" method="POST" onsubmit="return validate()" class="container">
    <div class="centering-wrapper">
      <div class="section1 text-center">
        <div class="primary-header">Welcome back!</div>
        <div class="secondary-header">We're so excited to see you again!</div>
        <div class="input-position">
          <?php
          require_once('./components/component_errormsg.php')
          ?>

          <div class="form-group">
            <h5 class="input-placeholder" id="fname-txt">First name<span class="error-message" id="fname-error"></span></h5>
            <input onclick="clear_validate_error()" type="text" name="user_firstname" data-validate="str" data-min="2" data-max="50" class="form-style" id="logfname" autocomplete="off" style="margin-bottom: 20px;">
            <i class="input-icon uil uil-at"></i>
          </div>
          <div class="form-group">
            <h5 class="input-placeholder" id="lname-txt">Last name<span class="error-message" id="lname-error"></span></h5>
            <input onclick="clear_validate_error()" type="text" name="user_lastname" data-validate="str" data-min="2" data-max="50" class="form-style" id="loglname" autocomplete="off" style="margin-bottom: 20px;">
            <i class="input-icon uil uil-at"></i>
          </div>
          <div class="form-group">
            <h5 class="input-placeholder" id="email-txt">Email<span class="error-message" id="email-error"></span></h5>
            <input onclick="clear_validate_error()" type="text" name="user_email" data-validate="email" data-min="1" data-max="50" class="form-style" id="logemail" autocomplete="off" style="margin-bottom: 20px;">
            <i class="input-icon uil uil-at"></i>
          </div>
          <div class="form-group">
            <h5 class="input-placeholder" id="pword-txt">Password<span class="error-message" id="password-error"></span></h5>
            <input onclick="clear_validate_error()" type="password" name="user_password" data-validate="str" data-min="8" data-max="50" class="form-style" id="logpass" autocomplete="on" style="margin-bottom: 20px;">
            <i class="input-icon uil uil-lock-alt"></i>
          </div>
          <div class="form-group">
            <h5 class="input-placeholder" id="pwordc-txt">Confirm Password<span class="error-message" id="password-confirm-error"></span></h5>
            <input type="password" onclick="clear_validate_error()" name="user_confirm_password" data-match-name="user_confirm_password" data-validate="match" data-min="8" data-max="50" class="form-style" id="logpassconfirm">
            <i class="input-icon uil uil-lock-alt"></i>
          </div>
        </div>
        <div class="password-container"><a href="/login" class="link">Already have an account?</a></div>
        <div class="btn-position">

          <input class="btn" type="submit" value="signup">
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

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_bottom.php');
?>