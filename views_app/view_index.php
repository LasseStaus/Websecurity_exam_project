<?php

session_start();
if (!isset($_SESSION['user_uuid'])) {
    header('Location: /login');
    exit();
}

require('./db/db.php');
require('./db/fetch_products.php');
require('./db/globals.php');


require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_top.php');
?>
<main>
    <div class="product-container">


        <?php
        foreach ($products as $product) {
            $image = json_decode($product['product_image']);
        ?>

            <div class="product">
                <!--     <div> <strong>PRODUCT ID:</strong> <?= out($product['product_id']) ?></div> -->
                <img src="../product-images/<?= out($image[0]) ?>" alt="Image of <?= out($product['product_title']) ?>">
                <!--        <div> <strong>USER_ID:</strong> <?= out($_SESSION['user_uuid']) ?></div> -->
                <!--      <div class="time"> <?= out($product['product_timestamp']) ?></div> -->
                <div class="title"> <?= out($product['product_title']) ?></div>
                <!--     <div class="desc"> <?= out($product['product_description']) ?></div> -->
                <div class="price"> <?= out($product['product_price']) ?> <span>Dkk</span></div>
                <!--          <div class="category"> <?= out($product['product_category']) ?></div> -->
                <a href="/single-product/<?= $product['product_id'] ?>"></a>
            </div>
        <?php
        }
        ?>

    </div>
</main>


<!-- <script src="/js/togglers.js"></script> -->

<script src="/js/search.js"></script>
</body>

</html>