<?php

session_start();
if (!isset($_SESSION['user_uuid'])) {
  header('Location: /login');
  exit();
}

require('./db/db.php');
require('./db/fetch_product.php');
require('./db/globals.php');

/* foreach ($products as $product) {
$images = json_decode($product['product_image']);
foreach ($images as $image) {
var_dump($image);
echo '<br>';

?>
      <img src="../product-images/<?= out($image) ?>" alt="">

  <?php

  }

 */

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
              <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_1.jpg" alt="shoe image">
              <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg" alt="shoe image">
              <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg" alt="shoe image">
              <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_4.jpg" alt="shoe image">
            </div>
          </div>
          <div class="img-select">
            <div class="img-item">
              <a href="#" data-id="1">
                <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_1.jpg" alt="shoe image">
              </a>
            </div>
            <div class="img-item">
              <a href="#" data-id="2">
                <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg" alt="shoe image">
              </a>
            </div>
            <div class="img-item">
              <a href="#" data-id="3">
                <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg" alt="shoe image">
              </a>
            </div>
            <div class="img-item">
              <a href="#" data-id="4">
                <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_4.jpg" alt="shoe image">
              </a>
            </div>
          </div>
        </div>
        <!-- card right -->
        <div class="product-content">
          <h2 class="product-title"> <?= out($product['product_title']) ?> </h2>
          <div class="flex wrap column">
            <p>Created: <span class="small"><?= out($product['product_timestamp']) ?></span></p>
          </div>
          <div class="flex wrap column">
            <p>By: <span class="small"><?= out($product['user_uuid']) ?></span></p>
          </div>
          <div class="product-price">
            <p class="last-price">Old Price: <span>$257.00</span></p>
            <p class="new-price">New Price: <span>$<?= out($product['product_price']) ?> </span></p>
          </div>
          <div class="product-detail">
            <h2>about this item: </h2>
            <p><?= out($product['product_description']) ?></p>
            <ul>
              <li>Created: <span><?= out($product['product_timestamp']) ?></span></li>
              <li>Title: <span><?= out($product['product_title']) ?></span></li>
              <li>Category: <span><?= out($product['product_category']) ?></span></li>
              <li>Price: <span><?= out($product['product_price']) ?></span></li>
            </ul>
          </div>
          <hr>
          <div class="purchase-info">
            <h3 class="contact-title">Contact</h3>
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
</main>


<script src="/js/singleProduct.js"></script>
<script src="/js/headerScroll.js"></script>
</body>

</html>