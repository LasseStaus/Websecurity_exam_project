<?php
require('./db/fetch_user_products.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_top.php');

?>
<main>

    <a href="/admin-index">Go back</a>
    <h1>Products of <?= $user_firstname ?> <?= $user_lastname ?></h1>
    <h2>ID: <?= $user_id ?></h2>
    <div class="page-container">


        <div id="search_results"></div>
        <table class="users-container">
            <tr class="user">
                <th>Product id</th>
                <th>Product title</th>
                <th>Product price</th>
                <th>Product category</th>
                <th>Product timestamp</th>
                <th>Product status</th>
                <th>Change status</th>
            </tr>
            <?php
            foreach ($products as $product) {

            ?>

                <tr class="user">
                    <td><?= out($product['product_id']) ?></td>
                    <td><?= out($product['product_title']) ?></td>
                    <td><?= out($product['product_price']) ?></td>
                    <td><?= out($product['product_category']) ?></td>
                    <td><?= out($product['product_timestamp']) ?></td>
                    <td>
                        <?php if ($product['product_status'] == 1) { ?>
                            Published
                        <?php } else {
                        ?> Unpublished <?php
                                    } ?></td>
                    <td>
                        <form action="/admin/change-product-status" method="POST">
                            <input name="csrf" type="hidden" value="<?= set_csrf() ?>">
                            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                            <input type="hidden" name="user_uuid" value="<?= $product['user_uuid'] ?>">
                            <input type="hidden" name="product_status" value="<?= $product['product_status'] ?>">
                            <button type="submit"> <?php if ($product['product_status'] == 1) { ?>Unpublish <?php } else {
                                                                                                            ?> Publish<?php
                                                                                                                    } ?>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</main>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_bottom.php');
?>