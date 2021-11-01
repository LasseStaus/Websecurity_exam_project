<?php

session_start();
if (!isset($_SESSION['user_uuid'])) {
    header('Location: /login');
    exit();
}

require('./db/db.php');
require('./db/peberString.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_top.php');


?>

<main>


    <form action="/create-new-product/<?= $_SESSION['user_uuid'] ?>" method="POST" enctype="multipart/form-data" onsubmit="return validate()">

        <div class="text">


            <input name="product_title" type="text" value="" placeholder="Post title" />
            <input name="product_subtitle" type="text" value="" placeholder="Post subtitle" />

            <input name="product_price" type="text" value="" placeholder="Post subtitle" />
            <input name="product_category" type="text" value="" placeholder="Post subtitle" />
            <!--     Select image to upload:

            <input type="file" name="fileToUpload" id="fileToUpload"> -->

            <textarea onclick="clear_validate_error()" name="product_description" placeholder="What's on your mind" data-validate="str" data-min="1" data-max="500"></textarea>

            <input type="submit" value="Create" />


        </div>

    </form>



</main>


<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_bottom.php');
?>