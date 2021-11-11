<?php

if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['user_uuid'])) {
  header('Location: /account');
  exit();
}
try {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
  $q = $db->prepare('SELECT * FROM users WHERE user_uuid = :user_uuid');
  $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
  $q->execute();
  $user = $q->fetch();
  if (!$user) {
    header('Location: /account');
    exit();
  }
?>

  <?php
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_top.php');
  ?>

  <main>

    <div class="content-container-profile">

      <div class="account-sidenav">
        <ul>
          <li>
            <h3>My DBA</h3>
          </li>
          <li>
            <a href="/account" class="active">My account</a>
          </li>
          <li>
            <a href="/account-edit/my-user-information"> My user information</a>
          </li>
          <li>
            <a href="/account-edit/change-password">Change password</a>
          </li>
          <li>
            <form action="/delete-account/<?= $_SESSION['user_uuid'] ?>" method="POST">
              <button type="submit" class="small">Delete account</button>
            </form>
          </li>
        </ul>
      </div>

      <div class="account-content">
        <h3 class="account-title">PROFILE TIMES</h3>

        <?php

        require_once($_SERVER['DOCUMENT_ROOT'] . '/components/component_succcessmsg.php');

        ?>
        <form id="update-profile-image" action="/upload-profile-image" method="POST" enctype="multipart/form-data" onsubmit="return validate();">
          <div class=" image-input-pair">
            <img class="img-show-input profile-image-upload profile-image" src="../profile-uploads/<?= $user['user_image'] ?>" alt="Profile image of  <?= $user['user_lastname'] ?>">
            <label class="icon-upload-label" for="upload-img"><i class="fas fa-camera"></i></label>
            <input class="file-to-upload" id="upload-img" type="file" name="file-to-upload" class="img-input" onchange="loadFile(event)" style=" display: none;">
          </div>
          <button class="button upload-profile-image" type="submit">Upload image</button>
        </form>

        <h3 class="account-title">My products</h3>
        <div class="content-wraper-profile">

          <div>







            <div class="options">


            </div>

          </div>



          <!-- ############## my products ##############s -->

          <?php
          require_once($_SERVER['DOCUMENT_ROOT'] . '/db/fetch_my_products.php');
          ?>



          <div class="product-container">
            <?php
            foreach ($user_products as $user_product) {
              $image = json_decode($user_product['product_image']);
            ?>

              <div class="product">
                <!--     <div> <strong>PRODUCT ID:</strong> <?= out($user_product['product_id']) ?></div> -->
                <img src="../product-images/<?= out($image[0]) ?>" alt="Image of <?= out($user_product['product_title']) ?>">
                <!--        <div> <strong>USER_ID:</strong> <?= out($_SESSION['user_uuid']) ?></div> -->
                <!--      <div class="time"> <?= out($user_product['product_timestamp']) ?></div> -->
                <div class="title"> <?= out($user_product['product_title']) ?></div>
                <!--     <div class="desc"> <?= out($user_product['product_description']) ?></div> -->
                <div class="price"> <?= out($user_product['product_price']) ?> <span>Dkk</span></div>
                <!--          <div class="category"> <?= out($user_product['product_category']) ?></div> -->
                <a href="/single-product/<?= $user_product['product_id'] ?>"></a>
              </div>
            <?php

            }
            ?>
          </div>
        </div>
      </div>
  </main>


<?php

  require_once($_SERVER['DOCUMENT_ROOT'] . '/views_app/view_bottom.php');
} catch (PDOException $ex) {
  echo $ex;
}
