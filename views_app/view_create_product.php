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
            <input id="input" type="file" name="file-to-upload[]" multiple id="fileToUpload" data-validate="file" data-min="1" data-max="4" value="Upload images" onchange="readURL(this)">
            <span>Please provide 1-4 images of the product</span>
        </div>
        <div id="test">

        </div>

        <button type=" submit" class="submit">Create product</button>

    </form>



</main>

<script>
    /*     let passedArray = <?php echo json_encode($image) ?>;
    const fileInput = document.querySelector("#input");

    let files = fileInput.files;

    console.log(files);
 */
    function readURL(element) {
        const div = document.getElementById("test");
        div.innerHTML = "";

        console.log('hek');
        const fileInput = element;
        let files = fileInput.files;
        for (var i = 0; i < files.length; i++) {

            let output = document.createElement("img")
            div.appendChild(output);
            output.src = URL.createObjectURL(event.target.files[i]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }






            /*            console.log(files[i].name);
                       let str = files[i].name;
                       let first = str.substr(0, str.indexOf(' '));
                       let second =
                       console.log(first) */

            //Do something
        }

    }
    /*  const fileInput = document.querySelector("#input");

     foreach(file in passedArray, () => {
         console.log(file);

     })

     passedArray.foreach(image, () => {
         console.log(image);
     }) */



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