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

      <div class="form-container-edit-account">

        <h3>Edit your account credentials</h3>

        <form id="update-account-information" method="POST" action="/update-account-information" onsubmit="return validate();">

          <div class="input-pair">
            <label for="user_firstname">First name </label>
            <input type="text" name="user_firstname" data-validate="str" data-min="2" data-max="50" value="<?= $user['user_firstname'] ?>">
          </div>

          <div class="input-pair">
            <label for="user_lastname"> Last name</label>
            <input type="text" name="user_lastname" data-validate="str" data-min="2" data-max="50" value="<?= $user['user_lastname'] ?>">
          </div>

          <div class="input-pair">
            <label for="user_email"> Email</label>
            <input type="text" name="user_email" data-validate="email" data-min="" data-max="" value="<?= $user['user_email'] ?>">
          </div>

          <div class="input-pair">
            <label for="user_phone"> Phone no.</label>
            <input type="text" name="user_phone" data-validate="int" data-min="2" data-max="10" value="<?= $user['user_phone'] ?>">
          </div>

          <button class="submit">Update user information</button>

        </form>


      </div>
    </div>

    </div>
    <?php
    if (isset($update_message)) { // isset() checks whether the variable is set/declared
    ?>
      <div class="update_message">
        <?= urldecode($update_message) ?>
        <!-- urldecode accepts the parameter $show_error (that holds the URL) to be decoded (no wierd symbols/encoding ##%) the function returns the decoded string on succes -->
      </div>
    <?php
    }
    if (isset($error_message)) {
    ?>
      <div class="error_message">
        ERROR <?= urldecode($error_message) ?>
      </div>
    <?php
    }
    ?>
  </main>


<?php

  require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_bottom.php');
} catch (PDOException $ex) {
  echo $ex;
}
