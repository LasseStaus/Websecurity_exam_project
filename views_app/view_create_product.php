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
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/components/component_errormsg.php');
    ?>
    <form id="create_product" action="/create-new-product/<?= $_SESSION['user_uuid'] ?>" method="POST" enctype="multipart/form-data" onsubmit="return validate()">

        <input name="csrf" type="hidden" value="<?= set_csrf() ?>">
        <div class="input-pair">
            <label for="product_title">Title </label>
            <input name="product_title" type="text" value="" placeholder="Enter title" data-validate="str" data-min="1" data-max="50" />
            <span>Please provide a title</span>
        </div>

        <div class="input-pair">
            <label for="product_price">price </label>
            <input name="product_price" type="text" value="" placeholder="Enter title" data-validate="int" data-min="1" data-max="50" />
            <span>Please provide price</span>
        </div>
        <div class="input-pair">
            <label for="product_category">category </label>
            <input name="product_category" type="text" value="" placeholder="Enter title" data-validate="str" data-min="1" data-max="50" />
            <span>Please provide a category</span>
        </div>
        <div class="input-pair">
            <label for="product_description">Description </label>
            <textarea name="product_description" placeholder="Enter description of your product" data-validate="str" data-min="1" data-max="500"></textarea>
            <span>Please provide a description of the product</span>
        </div>
        <div class="input-pair">
            <label for="product_images">Images</label>
            <input type="file" name="file-to-upload[]" multiple id="fileToUpload" data-validate="file" data-min="1" data-max="4" value="Upload images">
            <span>Please provide 1-4 images of the product</span>
        </div>

        <button type=" submit" class="submit">Create product</button>

    </form>



</main>

<script>
    /*   let loadFile = function(event) {
        var output = document.querySelector(".img-show-input");
        output.src = URL.createObjectURL(event.target.files[0]);
        output.classList.add("contain")
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
        const button = document.querySelector("button.upload-profile-image");
        button.classList.add("show");

    };
 */
    /*     function showInputImages(element) {
            if (element.files.length > 1 && element.files.length <= 4) {
                console.log("hej")
                console.log(element.files, "this")
                let image = document.createElement("img");
            }

        } */
</script>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_bottom.php');
?>