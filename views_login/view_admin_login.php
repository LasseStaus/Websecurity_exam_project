<?php

/* 
$adminsalt = bin2hex(openssl_random_pseudo_bytes(50));
$adminhashed = hash($algo, "admin" . $adminsalt . $peberstring);
echo $adminsalt;
echo "<br>";
echo $adminhashed;
exit(); */

require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_top.php');
session_start();
?>
<main>
  <canvas id="svgBlob"></canvas>
  <div class="position">
    <form action="/admin-login" method="POST" onsubmit="return validate()" class="container">
      <div class="centering-wrapper">
        <div class="section1 text-center">
          <div class="primary-header"> <h1>Sign in</h1></div>
          <div class="secondary-header">Sign in to your account</div>
          <div class="input-position">
            <?php
            require_once('./components/component_errormsg.php');
            require_once('./components/component_succcessmsg.php');

            ?>
            <input name="csrf" type="hidden" value="<?= set_csrf() ?>">

            <div class="form-group">
              <h5 class="input-placeholder" id="email-txt">Email<span id="email-error">Please provide a valid email</span></h5>
              <input onclick="clear_validate_error()" data-validate="email" type="email" name="admin_user_email" class="form-style" id="logemail" autocomplete="on" style="margin-bottom: 20px;">

              <i class="input-icon uil uil-at"></i>
            </div>
            <div class="form-group">
              <h5 class="input-placeholder" id="pword-txt">Password<span id="password-error">Sure you are an admin? | This password doesn't match any admin users</span></h5>
              <input onclick="clear_validate_error()" maxlength="50" data-validate="str" data-min="4" data-max="50" type="password" name="admin_user_password" class="form-style" id="logpass" autocomplete="on">
              <i class="input-icon uil uil-lock-alt"></i>
            </div>
    </form>
  </div>

  <div class="btn-position admin-btn">

    <button type="submit" class="btn">sign in<img src="/assets/imgs/anchorarrow.png" alt="arrow"></button>
<!--     <input class="btn" type="submit" value="sign in" ><img src="../assets/imgs/anchorarrow.png" alt="arrow">
 -->  </div>
  </div>

  <div class="qr-login">
    <div class="qr-container">
      <img class="logo" src="/assets/imgs/logo.png" />

    </div>
    <div class="qr-pheader">Admin login</div>
   
  </div>
  </div>
  </form>
  </div>


</main>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_login/view_bottom.php');
?>