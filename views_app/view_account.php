<?php

if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['user_uuid'])) {
  header('Location: /login');
  exit();
}


?>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_top.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/db/fetch_user.php');
?>

<main>

  <div class="content-container-profile">

    <div class="account-sidenav">
      <ul>
        <li>
          <h1>My account</h1>
        </li>
        <li>
          <a href="/account" class="active">My overview</a>
        </li>
        <li>
          <a href="/account-edit/my-user-information"> My user information</a>
        </li>
        <li>
          <a href="/account-edit/change-password">Change password</a>
        </li>
        <li>
          <button type="submit" class="button medium" onclick="open_confirm_modal_account()">Delete account</button>
        </li>
      </ul>
    </div>

    <div class="account-content flex column">
      <h2 class="h2">My overview</h2>

      <?php

      require_once($_SERVER['DOCUMENT_ROOT'] . '/components/component_succcessmsg.php');

      ?>

      <div class="flex flex_center_center row">

        <form id="update-profile-image" action="/upload-profile-image" method="POST" enctype="multipart/form-data" onsubmit="return validate();">

          <input name="csrf" type="hidden" value="<?= set_csrf() ?>">

          <div class=" flex_container column flex_center_center nowrap">
            <img class="img-show-input profile-image-upload profile-image" src="../profile-uploads/<?= $user['user_image'] ?>" alt="Profile image of  <?= $user['user_lastname'] ?>">
            <label class="icon-upload-label" for="upload-img"><i class="fas fa-camera"></i></label>
            <input class="file-to-upload" id="upload-img" type="file" name="file-to-upload" class="img-input" onchange="loadFile(event)" style=" display: none;">
          </div>
          <button class="button upload-profile-image" type="submit">Upload image</button>
        </form>
        <div class="account-subtitle">
          <p> <?= $user['user_firstname'] ?> <?= $user['user_lastname'] ?></p>
          <p> <?= $user['user_email'] ?></p>
        </div>
      </div>


      <!-- ############## my products ##############s -->

      <?php
      require_once($_SERVER['DOCUMENT_ROOT'] . '/db/fetch_my_products.php');
      ?>

      <div class="flex column">
        <h3>My products</h3>

        <?php
        require_once('./components/component_errormsg.php');
        require_once('./components/component_succcessmsg.php');
        ?>

        <div class="products-container">
          <?php
          foreach ($user_products as $user_product) {
            $image = json_decode($user_product['product_image']);
            $id = $user_product['product_id'];
          ?>

            <div class="product_container">
              <div class="product">
                <div>
                  <!--     <div> <strong>PRODUCT ID:</strong> <?= out($user_product['product_id']) ?></div> -->
                  <img src="../product-images/<?= out($image[0]) ?>" alt="Image of <?= out($user_product['product_title']) ?>">
                  <!--        <div> <strong>USER_ID:</strong> <?= out($_SESSION['user_uuid']) ?></div> -->
                  <!--      <div class="time"> <?= out($user_product['product_timestamp']) ?></div> -->
                </div>
                <div>
                  <div class="title"> <?= out($user_product['product_title']) ?></div>
                  <!--     <div class="desc"> <?= out($user_product['product_description']) ?></div> -->
                  <div class="price"> <?= out($user_product['product_price']) ?> <span>Dkk</span></div>
                  <!--          <div class="category"> <?= out($user_product['product_category']) ?></div> -->
                  <a href="/single-product/<?= $user_product['product_id'] ?>"></a>
                </div>
              </div>
              <div class="edit_product_container">
                <a id="<?= $user_product['product_id'] ?>" title="<?= $user_product['product_title'] ?>" class="pointer link" onclick="open_confirm_modal_product(this)">
                  Delete
                </a>
                <a class="link" href="/edit-product/<?= $user_product['product_id'] ?>">Edit</a>
              </div>
            </div>
          <?php

          }
          ?>
        </div>

        <div id="confirm_modal_delete_account" class="confirm_modal">
          <div class="confirm_modal_content">
            <h3>Are you sure?</h3>
            <form action="/delete-account" method="POST">
              <input name="csrf" type="hidden" value="<?= set_csrf() ?>">
              <button>Delete account</button>
            </form>
            <button class="close_account">Cancel</button>
          </div>
        </div>

        <div id="confirm_modal_delete_product" class="confirm_modal">
          <div class="confirm_modal_content">
            <h3>Are you sure you want to delete?</h3>
            <p id="product_name_show"> </p>
            <form action="/delete-product" method="POST">
              <input name="csrf" type="hidden" value="<?= set_csrf() ?>">
              <input type="hidden" name="user_product" id="user_product" value="">
              <button>Delete product</button>
            </form>
            <button class="close">Cancel</button>
          </div>
        </div>

      </div>
</main>

<script>
  // confirm modal delete account
  let modal_account = document.getElementById("confirm_modal_delete_account");
  let span_account = document.getElementsByClassName("close_account")[0];

  function open_confirm_modal_account() {
    modal_account.style.display = "block";
  }

  span_account.onclick = function() {
    modal_account.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal_account) {
      modal_account.style.display = "none";
    }
  }

  // confirm modal delete product
  let modal_product = document.getElementById("confirm_modal_delete_product");
  let span = document.getElementsByClassName("close")[0];
  const input = document.querySelector('#user_product');

  function open_confirm_modal_product(element) {
    modal_product.style.display = "block";
    input.value = element.id;
    let product_title = element.title;
    document.getElementById('product_name_show').innerHTML = product_title
  }

  span.onclick = function() {
    modal_product.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal_product) {
      modal_product.style.display = "none";
    }
  }
</script>


<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_bottom.php');
