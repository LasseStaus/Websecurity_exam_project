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

<main>
    <h1>HEJSA HENRIk</h1>
    <h2><?= $product['product_title'] ?></h2>
    <div class="product">
        <div> <strong>USER_ID:</strong> <?= $_SESSION['user_uuid'] ?></div>
        <div> <strong>TS:</strong> <?= $product['product_timestamp'] ?></div>
        <div> <strong>TITLE:</strong> <?= $product['product_title'] ?></div>
        <div> <strong>DESCRIPTION:</strong> <?= $product['product_description'] ?></div>
        <div> <strong>PRICE:</strong> <?= $product['product_price'] ?></div>
        <div> <strong>category:</strong> <?= $product['product_category'] ?></div>
    </div>
    <?php

    ?>









</main>


<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_bottom.php');
?>