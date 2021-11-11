<?php

session_start();
if (!isset($_SESSION['user_uuid'])) {
    header('Location: /login');
    exit();
}

require('./db/db.php');
require('./db/globals.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_top.php');

require('./db/fetch_product.php');
$message = out(openssl_decrypt(base64_decode($product['product_description']), $encrypt_algo, $key, OPENSSL_RAW_DATA, base64_decode($product['product_iv'])));
$image = json_decode($product['product_image']);
?>

<main>
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/components/component_errormsg.php');
    ?>

    <h3>Edit Product</h3>
    <form id="create_product" action="/create-new-product/<?= $_SESSION['user_uuid'] ?>" method="POST" enctype="multipart/form-data" onsubmit="return validate()">

        <input name="csrf" type="hidden" value="<?= set_csrf() ?>">
        <div class="input-pair">
            <label for="product_title">Title </label>
            <input name="product_title" type="text" value="<?= $product['product_title'] ?>" placeholder="Enter title" data-validate="str" data-min="1" data-max="50" />
            <span>Please provide a title</span>
        </div>

        <div class="input-pair">
            <label for="product_price">price </label>
            <input name="product_price" type="text" value="<?= $product['product_price'] ?>" placeholder="Enter title" data-validate="int" data-min="1" data-max="50" />
            <span>Please provide price</span>
        </div>
        <div class="input-pair">
            <label for="product_category">category </label>
            <input name="product_category" type="text" value="<?= $product['product_category'] ?>" placeholder="Enter title" data-validate="str" data-min="1" data-max="50" />
            <span>Please provide a category</span>
        </div>
        <div class="input-pair">
            <label for="product_description">Description </label>
            <textarea name="product_description" data-validate="str" data-min="1" data-max="500"><?= $message ?></textarea>
            <span>Please provide a description of the product</span>
        </div>
        <div class="input-pair">
            <label for="product_images">Images</label>
            <input id="input" type="file" name="file-to-upload[]" multiple id="fileToUpload" data-validate="file" data-min="1" data-max="4" value="<?= out($image[0]) ?>">
            <span>Please provide 1-4 images of the product</span>
        </div>

        <!--         <?php
                        foreach ($image as $img) {
                        ?>
            <div class="input-pair">
                <img src="../product-images/<?= out($img) ?>" alt="Current product image">
                <input type="file" name="file-to-upload[]" multiple id="fileToUpload" data-validate="file" data-min="1" data-max="4" value="<?= out($image[0]) ?>">

            </div>
        <?php
                        }
        ?> -->


        <button type=" submit" class="submit">Create product</button>

    </form>



</main>


<script>
    let passedArray = <?php echo json_encode($image) ?>;
    const fileInput = document.querySelector("#input");
    console.log(passedArray);
    const dataTransfer = new DataTransfer()
    let newArray = [];
    for (var i = 0; i < passedArray.length; i++) {
        console.log(passedArray[i]);
        const file = new File(['Hello world!'], passedArray[i], {
            type: 'png',
            tmp_name: 'png'
        })
        console.log(file);
        dataTransfer.items.add(file)
        //Do something
    }
    fileInput.files = dataTransfer.files
    /*  const fileInput = document.querySelector("#input");

     foreach(file in passedArray, () => {
         console.log(file);

     })

     passedArray.foreach(image, () => {
         console.log(image);
     }) */


    const file = new File(['Hello world!'], 'hello.txt', {
        type: 'text/plain'
    })

    /*     dataTransfer.items.add(file)

        fileInput.files = dataTransfer.files */

    /* 
        function getFiles(input) {
            const files = new Array(input.files.length)
            for (let i = 0; i < input.files.length; i++)
                files[i] = input.files.item(i)
            return files
        }

        setFiles(document.querySelector("#input"), passedArray);

        function setFiles(input, files) {
            const dataTransfer = new DataTransfer()
            for (const file of files)
                dataTransfer.items.add(file)
            fileInput.files = dataTransfer.files
        } */
</script>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_bottom.php');
?>