<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_top.php');
session_start();
?>
<?php
?>


<main>
  <canvas id="svgBlob"></canvas>
  <div class="position">
    <form action="/signup" name="signup_form" method="POST" onsubmit="return validate()" class="signup-container">
      <div class="centering-wrapper">
        <div class="section1 text-center">
          <div class="primary-header"><h1>Sign up</h1></div>
          <div class="secondary-header">Create a new account</div>
          <div class="input-position">
            <?php
            require_once('./components/component_errormsg.php');
            require_once('./components/component_succcessmsg.php');
            ?>
            <input name="csrf" type="hidden" value="<?= set_csrf() ?>">
            <div class="form-group">
              <h5 class="input-placeholder" id="fname-txt">First name</h5>
              <input onclick="clear_validate_error()" type="text" name="user_firstname" data-validate="str" data-min="2" data-max="50" class="form-style" value="" id="logfname" autocomplete="off" >
              <span class="error-message" id="fname-error">Please provide a first name | 2-50 characters</span>
              <i class="input-icon uil uil-at"></i>
            </div>
            <div class="form-group">
              <h5 class="input-placeholder" id="lname-txt">Last name</h5>
              <input onclick="clear_validate_error()" type="text" name="user_lastname" data-validate="str" data-min="2" data-max="50" class="form-style" id="loglname" autocomplete="off" >
              <span class="error-message" id="lname-error">Please provide a last name | 2-50 characters</span>
              <i class="input-icon uil uil-at"></i>
            </div>
            <div class="form-group">
              <h5 class="input-placeholder" id="email-txt">Email</h5>
              <input onclick="clear_validate_error()" type="text" name="user_email" data-validate="email" data-min="1" data-max="50" class="form-style" id="logemail" autocomplete="off" >
              <span class="error-message" id="email-error">Please provide a valid email</span>
              <i class="input-icon uil uil-at"></i>
            </div>
            <div class="form-group">
              <h5 class="input-placeholder" id="phone-txt">Phone</h5>
              <input onclick="clear_validate_error()" type="text" name="user_phone" pattern="\d*" data-validate="int" data-min="8" data-max="8" class="form-style" id="logemail" autocomplete="off" >
              <span class="error-message" id="email-error">Please provide a valid phone nr. (8 digits)</span>
              <i class="input-icon uil uil-at"></i>
            </div>
            <div class="form-group">
              <h5 class="input-placeholder" id="pword-txt">Password</h5>
              <input onclick="clear_validate_error()" type="password" name="user_password" data-validate="str" data-min="8" data-max="50" class="form-style" id="logpass" autocomplete="on" >
              <span class="error-message" id="password-error">Please provide a valid password | 8-50 characters</span>
              <i class="input-icon uil uil-lock-alt"></i>
            </div>
            <div class="form-group">
              <h5 class="input-placeholder" id="pwordc-txt">Confirm Password</h5>
              <input type="password" onclick="clear_validate_error()" name="user_confirm_password" data-match-name="user_confirm_password" data-validate="match" data-min="8" data-max="50" class="form-style" id="logpassconfirm">
              <span class="error-message" id="password-confirm-error">Your password &amp; confirm password must match | 8-50 characters</span>
              <i class="input-icon uil uil-lock-alt"></i>
            </div>
          </div>
          <div class="password-container"><a href="/login" class="link">Already have an account?</a></div>
          <div class="btn-position">
          <button type="submit" class="btn">sign up<img src="../assets/imgs/anchorarrow.png" alt="arrow"></button>

           <!--  <input class="btn" type="submit" value="signup"> -->
          </div>
        </div>

        <div class="qr-signup">
    <div class="qr-container-sign-up">
      <img class="logo" src="/assets/imgs/logo.png" />

    </div>
    <div class="qr-pheader">Klik<span>&amp;</span>Køb</div>
<!--     <div class="qr-sheader">Join the community <br> <strong>use our app </strong><br>to log in instantly.</div>
 -->    <div class="qr-sheader"> <a href="/login" class="btn2">sign in<img src="../assets/imgs/anchorarrow.png" alt="arrow"></a></div>
  </div>
  </div>
  </form>
  </div>


</main>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_bottom.php');
?>