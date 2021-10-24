<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ajax font-awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />    
   
    <!-- custom css-->
    <link rel="stylesheet" href="/css/login.css">
    
    <title>Discord</title>
</head>
<body>

    <canvas id="svgBlob"></canvas>

<div class="position">
  <form action="/signup" method="POST" onsubmit="return validate()" class="container">
    <div class="centering-wrapper">
      <div class="section1 text-center">
        <div class="primary-header">Welcome back!</div>
        <div class="secondary-header">We're so excited to see you again!</div>
        <div class="input-position">

        <?php

if(isset($error_message)){
?>


<div class="error-msg">
<strong>Error:</strong> <code><?= urldecode($error_message) ?></code>
</div>
  <?php
}

?>

       <!--  <form action="/signup" method="POST" onsubmit="return validate()"> -->
            <div class="form-group">
                <h5 class="input-placeholder" id="fname-txt">First name<span class="error-message" id="fname-error"></span></h5>
            <input  onclick="clear_validate_error()" type="text" name="user_firstname" data-validate="str" data-min="2" data-max="50" class="form-style" id="logfname" autocomplete="off" style="margin-bottom: 20px;">
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
        <!--   <a href="#" class="btn">signup</a> -->
          <input class="btn" type="submit" value="signup">
        </div>
      </div>
      <div class="horizontalSeparator"></div>
      <div class="qr-login">
        <div class="qr-container">
          <img class="logo" src="/svg/discord_logo-freelogovectors.net_.svg"/>
          
        </div>
        <div class="qr-pheader">Hej Henrik! undskyld Henrik!</div>
        <div class="qr-sheader">Join the community <strong>use our app </strong>to log in instantly.</div>
      </div>
    </div>
  </form>
</div>

<!-- ajax qrious js lib -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>

<!-- custom js -->

<script src="/p-js/signup.js"></script>
<script src="/p-js/validator.js"></script>
</body>
</html>