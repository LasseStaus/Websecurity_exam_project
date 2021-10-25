<?php

session_start();
if (!isset($_SESSION['user_uuid'])) {
    header('Location: /login');
    exit();
}

require('./db/db.php');
require('./db/fetch_posts.php');
require('./db/peberString.php');
/* require('./functions/globals.php'); */
/* function out($data)
{
    var_dump(($data));
    echo htmlspecialchars($data);
}
 */

try {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
    $q = $db->prepare('SELECT * FROM posts ORDER BY post_timestamp ASC');
    $q->execute();

    $posts = $q->fetchAll();
} catch (PDOException $ex) {
    echo $ex;
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_top.php');
?>

<main class="container-grid">
    <div class="sidebar-left">
        <div class="channels-container">
            <div class="channel">
                <img src="/assets/imgs/placeholder.svg" alt="">
                <span class="tooltip">WebSec</span>
            </div>
            <div class="channel">
                <img src="/assets/imgs/placeholder.svg" alt="">
                <span class="tooltip">Luksus</span>
            </div>
            <div class="channel">
                <img src="/assets/imgs/placeholder.svg" alt="">
                <span class="tooltip">Kantinen</span>
            </div>
        </div>
        <div class="channel-information">
        </div>
    </div>
    <div class="main-content chat-content">
        <div class="messages-wrapper">
            <div class="scroller" id="scroller">
                <div class="post-container post-grid">
                    <?php
                    foreach ($posts as $post) {
                        $message = out(openssl_decrypt(base64_decode($post['post_message']), $encrypt_algo, $key, OPENSSL_RAW_DATA, base64_decode($post['post_iv'])));
                    ?>
                        <div class="message-content">


                            <img src="/assets/imgs/avatar.jpg" alt="User avatar image">
                            <div class="message">
                                <div class="message-user-information">
                                    <h5><?= $post['post_creator_firstname'] ?> <?= $post['post_creator_lastname'] ?>
                                        <span><?= $post['post_timestamp'] ?></span>
                                    </h5>
                                </div>

                                <div class="encrypted">
                                    <h5>Post created by: <?= $post['user_uuid'] ?></h5>
                                    <p>ENCRYPTED <?= $post['post_message'] ?></p>
                                    <br>
                                    <p>DECRYPTED BASEENCODE <?= base64_decode($post['post_message']) ?></p>
                                    <br>
                                    <p>DECRYPTED <?= $message ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <form id="post-form" action="/create-post" method="POST">
            <div class="post-form-content">
                <div class="attach"><i class='bx bxs-plus-circle'></i></div>


                <textarea name="post_message" id="" placeholder="enter emssage here" type="submit"></textarea>

                <!--    <label for="" class="input-sizer">

                <textarea oninput="this.parentNode.dataset.value = this.value" rows="1" placeholder="hi"></textarea>
            </label> -->

                <!--  <input type="submit"> -->

                <button class="submit" type="submit"> <i class='bx bxs-send'></i></button>


                <div class="emoji">
                    <i class='bx bxs-smile'></i>
                    <i class='bx bxs-gift'></i>

                </div>
            </div>
        </form>
    </div>
    <div class="sidebar-right">
        <a href="/logout">logout</a>
    </div>

</main>
<script>
    function gotoBottom(id) {
        let element = document.getElementById(id);
        element.scrollTop = element.scrollHeight - element.clientHeight;
    }
    gotoBottom('scroller');



    var textarea = document.querySelector('textarea');

    textarea.addEventListener('keydown', autosize);

    function autosize() {
        var el = this;
        setTimeout(function() {
            el.style.cssText = 'height:auto; padding:0';
            // for box-sizing other than "content-box" use:
            // el.style.cssText = '-moz-box-sizing:content-box';
            el.style.cssText = 'height:' + el.scrollHeight + 'px';
        }, 0);
    }

    autosize();
</script>




<!-- <a href="/logout">logout</a>
<h2>Hej. - Dit session id er : <?= $_SESSION['user_uuid'] ?> </h2>

<form id="post-form" action="/create-post" method="POST">
    <label for="post_message">Hvad vil du sige nu?...</label>
    <textarea name="post_message" maxlength="50" data-validate="str" data-min="2" data-max="50" type="text"></textarea>
    <input for="login-form" type="submit">
    Slå din fucking besked op NU
    </input>
</form> -->



<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_bottom.php');
?>