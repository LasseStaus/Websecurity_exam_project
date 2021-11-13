<?php

session_start();
if (!isset($_SESSION['user_uuid'])) {
    header('Location: /login');
    exit();
}

require('./db/db.php');
require('./db/fetch_product.php');
require('./db/globals.php');



$image = json_decode($product['product_image']);
$message = out(openssl_decrypt(base64_decode($product['product_description']), $encrypt_algo, $key, OPENSSL_RAW_DATA, base64_decode($product['product_iv'])));

require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_top.php');
?>
<main>
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/db/fetch_comments.php');
    ?>
    <section id="comments-section">
        <h3>Comment Section</h3>
        <form id="create_comment" action="/create-comment" method="POST">
            <h4>Write a comment to seller</h4>
            <input type="hidden" name="product_id" value="<?= $product_id ?>">
            <textarea name="comment_message" id="" placeholder="Add a comment"></textarea>
            <button class="submit" type="submit"> Send</button>
        </form>
        <div class="all-comments-container">
            <?php foreach ($comments as $comment) {

                $commentMessage = out(openssl_decrypt(base64_decode($comment['comment_message']), $encrypt_algo, $key, OPENSSL_RAW_DATA, base64_decode($comment['comment_iv'])));

            ?>
                <div class="single-comment-container">
                    <h2><?= $comment['comment_id'] ?></h2>
                    <img src="../product-images/1eb520be6cb2ff887b7cfae487cd6d76.png" alt="test">
                    <div href="#" class="heading"><?= $comment['user_firstname'] ?> <?= $comment['user_lastname'] ?> <span><?= $comment['comment_timestamp'] ?></span></div>
                    <div class="comment-content"><?= $commentMessage ?> </div>
                    <button class="replybtn" type="button" data-target="<?= $comment['comment_id'] ?>" onclick="printReplyForm(this)">Reply</button>
                    <form action="/create-reply/<?= $comment['comment_id'] ?>" method="POST" class="reply-form" id="comment-1-reply-form">
                        <input type="hidden" name="product_id" value="<?= $product_id ?>">
                        <textarea name="reply_message" placeholder="Reply to comment" rows="4">sadasdasd</textarea>
                        <input type="submit" value="submitlll">
                        <!--     <button type="button" onclick="cancelReply(this)">Cancel</button> -->
                    </form>
                </div>
                <div class="replies">
                    <?php
                    $comment_id = $comment['comment_id'];
                    require($_SERVER['DOCUMENT_ROOT'] . '/db/fetch_replies.php');
                    foreach ($replies as $reply) {
                        $replyMessage = out(openssl_decrypt(base64_decode($reply['reply_body']), $encrypt_algo, $key, OPENSSL_RAW_DATA, base64_decode($reply['reply_iv'])));
                    ?>
                        <h2><?= $comment_id ?></h2>
                        <h2><?= $reply['reply_id'] ?></h2>

                        <p><?= $replyMessage ?> </p>

                    <?php
                    }
                    ?>
                </div>

            <?php
            }
            ?>
        </div>

    </section>

</main>


<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_bottom.php');
?>