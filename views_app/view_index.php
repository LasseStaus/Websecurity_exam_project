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
<main id="index">
    <div class="broad-page-container">

        <div class="search-container">
            <div class="">

            </div>
            <form onsubmit="return false" id="search-form">
                <i class="fas fa-search"></i>
                <input class="search-input" name="search_for" type="text" placeholder="Search for product" oninput=search(); onclick="show_results()">
                <i class="clear-input fas fa-times-circle" onclick="clear_input()"></i>
            </form>

        </div>


        <section id="newest-products">
            <h3 class="h1 section-header">Newest Products</h3>
            <div class="new-products-container">


                <?php require('./db/fetch_newest_products.php');
                foreach ($newest_products as $product) {
                    $image = json_decode($product['product_image']);
                    $newest_description = out(openssl_decrypt(base64_decode($product['product_description']), $encrypt_algo, $key, OPENSSL_RAW_DATA, base64_decode($product['product_iv'])));
                ?>

                    <div class="product">
                        <div class="img-container">
                            <img src="../product-images/<?= out($image[0]) ?>" alt="Image of <?= out($product['product_title']) ?>">
                        </div>
                        <div class="product-info">
                            <div class="product-info-top">
                                <div class="title"> <?= out($product['product_title']) ?></div>
                                <div class="price"> <?= out($product['product_price']) ?> <span>Dkk</span></div>
                            </div>
                            <p class="description">
                                <?= $newest_description ?>
                            </p>
                        </div>
                        <a href="/single-product/<?= $product['product_id'] ?>"></a>
                    </div>
                <?php
                }

                ?>
            </div>

        </section>
        <section id="main-content">
            <h3 class="h1 section-header search-result-amount">All Products</h3>
            <div class="main-content-container">

                <div id="search_results"></div>
                <div class="product-container">
                    <?php
                    foreach ($products as $product) {
                        $image = json_decode($product['product_image']);
                        $description = out(openssl_decrypt(base64_decode($product['product_description']), $encrypt_algo, $key, OPENSSL_RAW_DATA, base64_decode($product['product_iv'])));
                    ?>
                        <div class="product">
                            <div class="img-container">
                                <img src="../product-images/<?= out($image[0]) ?>" alt="Image of <?= out($product['product_title']) ?>">
                            </div>
                            <div class="product-info">
                                <div class="product-info-top">
                                    <div class="title"> <?= out($product['product_title']) ?></div>
                                    <div class="price"> <?= out($product['product_price']) ?> <span>Dkk</span></div>
                                </div>
                                <p class="description">
                                    <?= $description ?>
                                </p>
                            </div>
                            <a href="/single-product/<?= $product['product_id'] ?>"></a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>
</main>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_bottom.php');
?>