<?php
session_start();
if (!isset($_SESSION['user_uuid'])) {
  header('Location: /login');
  exit();
}

try {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
  $q = $db->prepare('SELECT * FROM users WHERE user_uuid = :user_uuid');
  $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
  $q->execute();
  $user = $q->fetch();
  if (!$user) {
    header('Location: /login');
    exit();
  }
?>

  <?php
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_top.php');
  ?>
  <main>

    <div class="content-container-profile">

      <div class="account-sidenav">
        <ul>
          <li>
            <h3>My DBA</h3>
          </li>
          <li>
            <a href="/account">My account</a>
          </li>
          <li>
            <a href="/account-edit/my-user-information" class="active"> My user information</a>
          </li>
          <li>
            <a href="/account-edit/change-password">Change password</a>
          </li>
        </ul>
      </div>
      <div class="account-content">
        <h3 class="account-title">Edit your account credentials</h3>


        <?php
        require_once('./components/component_errormsg.php');
        require_once('./components/component_succcessmsg.php');
        ?>

        <form id="update-account-information" method="POST" action="/update-account-information">
          <input name="csrf" type="hidden" value="<?= set_csrf() ?>">
          <div class="input-pair">
            <label for="user_firstname">First name </label>
            <input type="text" name="user_firstname" data-validate="str" data-min="2" data-max="50" value="<?= $user['user_firstname'] ?>">
            <span>Please provide a first name | 2-50 characters</span>
          </div>

          <div class="input-pair">
            <label for="user_lastname"> Last name</label>
            <input type="text" name="user_lastname" data-validate="str" data-min="2" data-max="50" value="<?= $user['user_lastname'] ?>">
            <span>Please provide a last name | 2-50 characters</span>
          </div>

          <div class="input-pair">
            <label for="user_email"> Email</label>
            <input type="text" name="user_email" data-validate="email" data-min="" data-max="" value="<?= $user['user_email'] ?>">
            <span>Please provide a valid email</span>
          </div>

          <div class="input-pair">
            <label for="user_phone"> Phone no.</label>
            <input type="text" name="user_phone" data-validate="int" data-min="2" data-max="10" value="<?= $user['user_phone'] ?>">
            <span>Please provide a valid phone nr. (8 digits)</span>
          </div>

          <button type="submit" class="submit">Update user information</button>

        </form>
      </div>

    </div>

    </div>

  </main>

<?php

  require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_bottom.php');
} catch (PDOException $ex) {
  echo $ex;
}
