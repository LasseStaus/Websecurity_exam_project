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
      <div>
        <h1>Single product page</h1>
      </div>
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
              <p class="small">By: <span class="small"><?= out($_SESSION['user_firstname']) ?> <?= out($_SESSION['user_lastname']) ?></span></p>
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
              <!--       <span><?= out($_SESSION['user_phone']) ?></span>-->
              <!--       <span><?= out($_SESSION['user_email']) ?></span>-->
              <span><i class="fas fa-phone"></i> <a href="tel:xx-xx-xx-xx">xx xx xx xx</a></span>
              <span><i class="fas fa-envelope"></i> <a href="mailto:seller@mail.com">seller@mail.com</a></span>
            </div>
            <br>
            <button type="button" class="btn">
              Chat with seller <i class="fas fa-user"></i>
            </button>
          </div>


        </div>
      </div>
    </div>

    <div class="comments-container">
      <h3>Questions and answers </h3>
      <div>
        <form id="create_comment" action="/create-comment" method="POST">
          <input type="hidden" name="product_id" value="<?= $product_id ?>">
          <textarea name="comment_message" id="" placeholder="Add a comment" type="submit"></textarea>

          <button class="submit" type="submit"> Send</button>
        </form>
      </div>

      <div>
        <?php
        require_once($_SERVER['DOCUMENT_ROOT'] . '/db/fetch_comments.php');
        ?>

        <div class="product-comments-container">
          <?php
          foreach ($comments as $comment) {

            $message = out(openssl_decrypt(base64_decode($comment['comment_message']), $encrypt_algo, $key, OPENSSL_RAW_DATA, base64_decode($comment['comment_iv'])));
          ?>
            <div class="product-comment">



              <img src="../profile-uploads/<?= $comment['user_image'] ?>" alt="User avatar image">
              <div class="message">
                <div class="message-user-information">
                  <h5>
                    <span><?= $comment['comment_timestamp'] ?></span>
                  </h5>
                </div>

                <div class="message-text">
                  <p><?= $message ?></p>


                </div>


                <div class="encrypted">
                  <p class="small">Encrypted message <?= $comment['comment_message'] ?></p>

                  <p class="small">Decrypted message <?= base64_decode($comment['comment_message']) ?></p>

                </div>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>

    </div>

  </div>
</main>


<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_bottom.php');
?>