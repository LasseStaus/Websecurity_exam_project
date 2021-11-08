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
                        <a href="/account-edit/my-user-information"> My user information</a>
                    </li>
                    <li>
                        <a href="/account-edit/change-password" class="active">Change password</a>
                    </li>
                </ul>
            </div>

            <div class="form-container-edit-account">

                <h3>Change password</h3>

                <form id="update-account-information" method="POST" action="/update-user-account-password" onsubmit="return validate();">

                    <div class="input-pair">
                        <label for="user_password">New Password</label>
                        <input type="password" name="user_password" data-validate="str" data-min="4" data-max="16" placeholder="Enter new password  ">
                    </div>

                    <div class="input-pair">
                        <label for="user_confirm_password">Confirm New Password</label>
                        <input type="password" name="user_confirm_password" data-match-name="user_password" data-validate="match" data-min="4" data-max="16" placeholder="Confirm new password">
                    </div>

                    <button class="submit">Change password</button>

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

    </body>

    </html>

<?php
} catch (PDOException $ex) {
    echo $ex;
}
