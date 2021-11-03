<?php

session_start();
if (!isset($_SESSION['user_uuid'])) {
    header('Location: /login');
    exit();
}

require('./db/db.php');
require('./db/globals.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_top.php');


?>

<main>
    <form id="create_product" action="/create-new-product/<?= $_SESSION['user_uuid'] ?>" method="POST" enctype="multipart/form-data" onsubmit="return validate()">

        <input name="csrf" type="hidden" value="<?= set_csrf() ?>">
        <div class="input-pair">
            <label for="product_title">Title</label>
            <input name="product_title" type="text" value="" placeholder="Enter title" />
        </div>
        <div class="input-pair">
            <label for="product_subtitle">Subtitle</label>
            <input name="product_subtitle" type="text" value="" placeholder="Enter title" />
        </div>
        <div class="input-pair">
            <label for="product_price">price</label>
            <input name="product_price" type="text" value="" placeholder="Enter title" />
        </div>
        <div class="input-pair">
            <label for="product_category">category</label>
            <input name="product_category" type="text" value="" placeholder="Enter title" />
        </div>
        <div class="input-pair">
            <label for="product_Description">Description</label>
            <textarea onclick="clear_validate_error()" name="product_description" placeholder="Enter description of your product" data-validate="str" data-min="1" data-max="500"></textarea>
        </div>


        <div class="input-pair">
            <label for="product_images">Images</label>
            <input type="file" name="file-to-upload[]" multiple id="fileToUpload" value="Upload images">
        </div>


        <button type="submit" class="submit">Create product</button>



    </form>



</main>

</body>

</html>