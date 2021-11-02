<?php

session_start();
if (!isset($_SESSION['user_uuid'])) {
    header('Location: /login');
    exit();
}

require('./db/db.php');
require('./db/fetch_product.php');
require('./db/peberString.php');

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
<link rel="stylesheet" href="/css/singleProduct.css">
<link rel="stylesheet" href="/css/comments.css">
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
      <h2 class = "product-title"> <?= out($product['product_title']) ?> </h2>
      <div class="flex wrap column"><p>Created: <span class="small"><?= out($product['product_timestamp']) ?></span></p></div>
      <div class="flex wrap column"><p>By: <span class="small"><?= out($product['user_uuid']) ?></span></p></div>


      <div class = "product-price">
        <p class = "last-price">Old Price: <span>$257.00</span></p>
        <p class = "new-price">New Price: <span>$<?= out($product['product_price']) ?> </span></p>
      </div>

      <div class = "product-detail">
        <h2>about this item: </h2>
        <p><?= out($product['product_description']) ?></p>
        <ul>
          <li>Created: <span><?= out($product['product_timestamp']) ?></span></li>
          <li>Title: <span><?= out($product['product_title']) ?></span></li>
          <li>Category: <span><?= out($product['product_category'] )?></span></li>
          <li>Price: <span><?= out($product['product_price'] )?></span></li>
          
        </ul>
      </div>
      <hr>


      <div class = "purchase-info">
          <h3 class="contact-title">Contact</h3>
      <div class = "product-detail flex wrap column">
<!--       <span><?= out($_SESSION['user_phone']) ?></span>-->    
<!--       <span><?= out($_SESSION['user_email']) ?></span>-->    
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

 <!-- Comments -->
 <h3 class="contact-title">Comments</h3>

    
<div class="container">
  <div class="col-md-12" id="fbcomment">
    <div class="header_comment">
      <div class="row">
        <div class="col-md-6 text-left">
          <span class="count_comment">264235 Comments</span>
        </div>
        <div class="col-md-6 text-right">
          <span class="sort_title">Sort by</span>
          <select class="sort_by">
          <option>Top</option>
          <option>Newest</option>
          <option>Oldest</option>
          </select>
        </div>
      </div>
    </div>

    <div class="body_comment">
      <div class="row">
        <div class="avatar_comment col-md-1">
          <img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar"/>
        </div>
        <div class="box_comment col-md-11">
          <textarea class="commentar" placeholder="Add a comment..."></textarea>
          <div class="box_post">
          <div class="pull-left">
            <input type="checkbox" id="post_fb"/>
            <label for="post_fb">Also post on Facebook</label>
          </div>
          <div class="pull-right">
            <span>
            <img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar" />
            <i class="fa fa-caret-down"></i>
            </span>
            <button onclick="submit_comment()" type="button" value="1">Post</button>
          </div>
          </div>
        </div>
      </div>
      <div class="row">
        <ul id="list_comment" class="col-md-12">
          <!-- Start List Comment 1 -->
          <li class="box_result row">
            <div class="avatar_comment col-md-1">
              <img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar"/>
            </div>
            <div class="result_comment col-md-11">
              <h4>Nath Ryuzaki</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.</p>
              <div class="tools_comment">
                <a class="like" href="#">Like</a>
                <span aria-hidden="true"> · </span>
                <a class="replay" href="#">Reply</a>
                <span aria-hidden="true"> · </span>
                <i class="fa fa-thumbs-o-up"></i> <span class="count">1</span> 
                <span aria-hidden="true"> · </span>
                <span>26m</span>
              </div>
              <ul class="child_replay">
                <li class="box_reply row">
                  <div class="avatar_comment col-md-1">
                    <img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar"/>
                  </div>
                   <div class="result_comment col-md-11">
                    <h4>Sugito</h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.</p>
                    <div class="tools_comment">
                      <a class="like" href="#">Like</a>
                      <span aria-hidden="true"> · </span>
                      <a class="replay" href="#">Reply</a>
                      <span aria-hidden="true"> · </span>
                      <i class="fa fa-thumbs-o-up"></i> <span class="count">1</span> 
                      <span aria-hidden="true"> · </span>
                      <span>26m</span>
                    </div>
                    <ul class="child_replay"></ul>
                  </div>
                </li>
              </ul>
            </div>
          </li>
          
          <!-- Start List Comment 2 -->
          <li class="box_result row">
            <div class="avatar_comment col-md-1">
              <img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar"/>
            </div>
            <div class="result_comment col-md-11">
              <h4>Gung Wah</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.</p>
              <div class="tools_comment">
                <a class="like" href="#">Like</a>
                <span aria-hidden="true"> · </span>
                <a class="replay" href="#">Reply</a>
                <span aria-hidden="true"> · </span>
                <i class="fa fa-thumbs-o-up"></i> <span class="count">1</span> 
                <span aria-hidden="true"> · </span>
                <span>26m</span>
              </div>
              <ul class="child_replay"></ul>
            </div>
          </li>
        </ul>
      <button class="show_more" type="button">Load 10 more comments</button>
      </div>
    </div>
  </div>
</div>





		




    <?php

    ?>









</main>

<script src="/js/singleProduct.js"></script>
<script src="/js/comments.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_bottom.php');
?>