<?php

session_start();
if (!isset($_SESSION['user_uuid'])) {
    header('Location: /login');
    exit();
}

require('./db/db.php');
require('./db/fetch_product.php');
require('./db/peberString.php');




require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_top.php');
?>
<link rel="stylesheet" href="/css/singleProduct.css">
<main>
<!-- <section id="section1" class="flex wrap column margin-10">

    <div class="flex wrap column">
    <div><a href="/">Go back</a></div>
    <div><h1>Single product page</h1></div>
    </div>
    <br>

 <div class="flex wrap row">
    <div class="row">
        <span>Product title: </span> <strong> <?= $product['product_title'] ?></strong>
    </div><div></div>
</div>
    <div class="product ">
        <div> <strong>USER_ID:</strong> <?= $_SESSION['user_uuid'] ?></div>
        <div> <strong>TS:</strong> <?= $product['product_timestamp'] ?></div>
        <div> <strong>TITLE:</strong> <?= $product['product_title'] ?></div>
        <div> <strong>DESCRIPTION:</strong> <?= $product['product_description'] ?></div>
        <div> <strong>PRICE:</strong> <?= $product['product_price'] ?></div>
        <div> <strong>category:</strong> <?= $product['product_category'] ?></div>
    </div>
    </section> -->
    <div class="flex wrap column">
    <div><a href="/">Go back</a></div>
    <div><h1>Single product page</h1></div>
    </div>

    <div class = "card-wrapper">
  <div class = "card">
    <!-- card left -->
    <div class = "product-imgs">
      <div class = "img-display">
        <div class = "img-showcase">
          <img src = "https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_1.jpg" alt = "shoe image">
          <img src = "https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg" alt = "shoe image">
          <img src = "https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg" alt = "shoe image">
          <img src = "https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_4.jpg" alt = "shoe image">
        </div>
      </div>
      <div class = "img-select">
        <div class = "img-item">
          <a href = "#" data-id = "1">
            <img src = "https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_1.jpg" alt = "shoe image">
          </a>
        </div>
        <div class = "img-item">
          <a href = "#" data-id = "2">
            <img src = "https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg" alt = "shoe image">
          </a>
        </div>
        <div class = "img-item">
          <a href = "#" data-id = "3">
            <img src = "https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg" alt = "shoe image">
          </a>
        </div>
        <div class = "img-item">
          <a href = "#" data-id = "4">
            <img src = "https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_4.jpg" alt = "shoe image">
          </a>
        </div>
      </div>
    </div>
    <!-- card right -->
    <div class = "product-content">
      <h2 class = "product-title"> <?= $product['product_title'] ?> </h2>
      <div class="flex wrap column"><p>Created: <span class="small"><?= $product['product_timestamp'] ?></span></p></div>
      <div class="flex wrap column"><p>By: <span class="small"><?= $product['user_uuid'] ?></span></p></div>


      <div class = "product-price">
        <p class = "last-price">Old Price: <span>$257.00</span></p>
        <p class = "new-price">New Price: <span>$<?= $product['product_price'] ?> </span></p>
      </div>

      <div class = "product-detail">
        <h2>about this item: </h2>
        <p><?= $product['product_description'] ?></p>
        <ul>
          <li>Created: <span><?= $product['product_timestamp'] ?></span></li>
          <li>Title: <span><?= $product['product_title'] ?></span></li>
          <li>Category: <span><?= $product['product_category'] ?></span></li>
          <li>Price: <span><?= $product['product_price'] ?></span></li>
          
        </ul>
      </div>
      <hr>


      <div class = "purchase-info">
          <h3 class="contact-title">Contact</h3>
      <div class = "product-detail flex wrap column">
<!--       <span><?= $_SESSION['user_phone'] ?></span>-->    
<!--       <span><?= $_SESSION['user_email'] ?></span>-->    
        <span><i class="fas fa-phone"></i> <a href="tel:xx-xx-xx-xx">xx xx xx xx</a></span>
        <span><i class="fas fa-envelope"></i> <a href="mailto:seller@mail.com">seller@mail.com</a></span>
      </div>
     
      <br>
      <button type = "button" class = "btn">
          Chat with seller <i class = "fas fa-user"></i>
        </button>
      </div>
<!-- 
      <div class = "social-links">
        <p>Share At: </p>
        <a href = "#">
          <i class = "fab fa-facebook-f"></i>
        </a>
        <a href = "#">
          <i class = "fab fa-twitter"></i>
        </a>
        <a href = "#">
          <i class = "fab fa-instagram"></i>
        </a>
        <a href = "#">
          <i class = "fab fa-whatsapp"></i>
        </a>
        <a href = "#">
          <i class = "fab fa-pinterest"></i>
        </a>
      </div> -->
    </div>
  </div>
</div>



    <?php

    ?>









</main>

<script src="/js/singleProduct.js"></script>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_bottom.php');
?>