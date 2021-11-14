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
  <div class="page-container">

    <div class="flex wrap column">
      <div><a href="/">Go back</a></div>
    </div>
    <div class="card-wrapper">
      <div class="card">
        <!-- card left -->
        <div class="product-imgs">
          <div class="img-display">
            <div class="img-showcase">
              <img src="../product-images/<?= out($image[0]) ?>" alt="product image">
              <img src="../product-images/<?= out($image[1]) ?>" alt="product image">
              <img src="../product-images/<?= out($image[2]) ?>" alt="product image">
              <img src="../product-images/<?= out($image[3]) ?>" alt="product image">

            </div>
          </div>
          <div class="img-select">
            <div class="img-item">
              <a href="#" data-id="1">
                <img src="../product-images/<?= out($image[0]) ?>" alt="product image">
              </a>
            </div>
            <div class="img-item">
              <a href="#" data-id="2">
                <img src="../product-images/<?= out($image[1]) ?>" alt="product image">
              </a>
            </div>
            <div class="img-item">
              <a href="#" data-id="3">
                <img src="../product-images/<?= out($image[2]) ?>" alt="product image">
              </a>
            </div>
            <div class="img-item">
              <a href="#" data-id="4">
                <img src="../product-images/<?= out($image[3]) ?>" alt="product image">
              </a>
            </div>
          </div>
        </div>
        <!-- card right -->
        <div class="product-content">
          <h2 class="product-title"> <?= out($product['product_title']) ?> </h2>
          <div class="flex wrap column">
            <div class="master-flex">
              <p class="small">Created: <span class="small"><?= out($product['product_timestamp']) ?></span></p>
              <p class="small">By: <span class="small"><?= out($product['user_firstname']) ?> <?= out($product['user_lastname']) ?></span></p>
            </div>
          </div>
          <div class="flex wrap column">
          </div>
          <div class="product-price">
            <div class="master-flex">
              <p class="new-price">Price:</p>
              <p><span><?= out($product['product_price']) ?></span> DKK</p>
            </div>
          </div>
          <div class="product-detail">
            <p class="new-price"><span>Description:</span></p>
            <p><?= $message ?></p>
          </div>
          <div class="product-detail">
            <p class="contact-title">Contact:</p>
          </div>
          <div class="purchase-info master-flex">
            <div class="product-detail flex wrap column">
              <span><i class="fas fa-phone"></i> <a href="tel:<?= out($product['user_phone']) ?>"><?= out($product['user_phone']) ?></a></span>
              <span><i class="fas fa-envelope"></i> <a href="mailto:<?= out($product['user_email']) ?>"><?= out($product['user_email']) ?></a></span>
            </div>
            <br>
            <button type="button" class="btn">
              Chat with seller <i class="fas fa-user"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/db/fetch_comments.php');
    ?>
    <section id="comments-section">

      <div class="create-comment-container">

        <div class="create-comment-form-container">
          <h4>Write a message to <?= out($product['user_firstname']) ?></h4>
          <img src="../profile-uploads/<?= $_SESSION['user_image'] ?>" alt="Image of <?= $_SESSION['user_firstname'] ?>">

          <form id="create_comment" action="/create-comment" method="POST">
            <input type="hidden" name="product_id" value="<?= $product_id ?>">
            <textarea name="comment_message" class="resize-ta" id="" placeholder="Add a comment"></textarea>
            <button class="submit-create-comment" type="submit"> Send</button>
          </form>
        </div>
      </div>
      <div class="all-comments-container">
        <?php foreach ($comments as $comment) {
          $commentMessage = out(openssl_decrypt(base64_decode($comment['comment_message']), $encrypt_algo, $key, OPENSSL_RAW_DATA, base64_decode($comment['comment_iv'])));
        ?>
          <div class="single-comment-container">

            <img src="../product-images/1eb520be6cb2ff887b7cfae487cd6d76.png" alt="test">
            <div class="heading">
              <h6><?= $comment['user_firstname'] ?> <?= $comment['user_lastname'] ?></h6><i class="circle fas fa-circle"></i><span><?= $comment['comment_timestamp'] ?></span>
            </div>
            <div class="comment-content"><?= $commentMessage ?> </div>
            <div class="comment-buttons">
              <div class="replies_number_container">
                <i class="fas fa-caret-down" onclick="showReplies(this)"></i>
                <span class="comment_replies_number"> 6 replies</span>
              </div>
              <i class="circle fas fa-circle"></i>
              <button class="replybtn" type="button" data-target="<?= $comment['comment_id'] ?>" onclick="showReplyForm(this)">Reply</button>

            </div>
            <form action="/create-reply/<?= $comment['comment_id'] ?>" data-target="<?= $comment['comment_id'] ?>" method="POST" class="reply-form">
              <input type="hidden" name="product_id" value="<?= $product_id ?>">
              <textarea name="reply_message" class="resize-ta" rows="0" placeholder="Reply to comment"></textarea>
              <button type="submit">Send</button>

              <i type="button" class="fas fa-times" onclick="cancelReply(this)"></i>
            </form>
            <div class="replies-container">
              <?php
              $comment_id = $comment['comment_id'];
              require($_SERVER['DOCUMENT_ROOT'] . '/db/fetch_replies.php');
              $count = 0;
              foreach ($replies as $reply) {
                $count++;
                $replyMessage = out(openssl_decrypt(base64_decode($reply['reply_body']), $encrypt_algo, $key, OPENSSL_RAW_DATA, base64_decode($reply['reply_iv'])));
              ?>
                <div class="single-reply-container" data-times="<?= $count ?>">
                  <img src="../profile-uploads/<?= $reply['user_image'] ?>" alt="Profile image of <?= $reply['user_firstname'] ?> ">
                  <div class="heading">
                    <h6><?= $reply['user_firstname'] ?> <?= $reply['user_lastname'] ?></h6><i class="circle fas fa-circle"></i><span><?= $reply['updated_at'] ?></span>
                  </div>
                  <div class="reply-message">


                    <p><?= $replyMessage ?> </p>

                  </div>
                </div>
              <?php
              }
              ?>
            </div>

          </div>

        <?php
        }
        ?>
      </div>

    </section>
  </div>
</main>


<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_bottom.php');
?>