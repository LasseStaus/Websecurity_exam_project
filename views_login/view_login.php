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
              <h5 class="input-placeholder" id="email-txt">Email<span id="email-error">Please provide a valid email</span></h5>
              <input onclick="clear_validate_error()" data-validate="email" type="email" name="user_email" class="form-style" id="logemail" autocomplete="on" style="margin-bottom: 20px;">

              <i class="input-icon uil uil-at"></i>
            </div>
            <div class="form-group">
              <h5 class="input-placeholder" id="pword-txt">Password<span id="password-error">Please provide a valid password | 8-50 characters</span></h5>
              <input onclick="clear_validate_error()" maxlength="50" data-validate="str" data-min="8" data-max="50" type="password" name="user_password" class="form-style" id="logpass" autocomplete="on">
              <i class="input-icon uil uil-lock-alt"></i>
            </div>
    </form>
  </div>

  <div class="password-container"><a href="#" class="link">Forgot your password</a></div>
  <div class="btn-position">

    <button type="submit" class="btn">sign in<img src="../assets/imgs/anchorarrow.png" alt="arrow"></button>
    <!--     <input class="btn" type="submit" value="sign in" ><img src="../assets/imgs/anchorarrow.png" alt="arrow">
 -->
  </div>
  </div>

  <div class="qr-login">
    <div class="qr-container">
      <img class="logo" src="/assets/imgs/logo.png" />

    </div>
    <div class="qr-pheader">Klik<span>&amp;</span>Køb</div>
    <!--     <div class="qr-sheader">Join the community <br> <strong>use our app </strong><br>to log in instantly.</div>
 -->
    <div class="qr-sheader"> <a href="/signup" class="btn2">sign up<img src="../assets/imgs/anchorarrow.png" alt="arrow"></a></div>
  </div>
  </div>
  </form>
  </div>


</main>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_bottom.php');
?>