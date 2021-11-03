<?php
session_start();

if (!isset($_SESSION['user_uuid'])) {
    header('Location: /login');
    exit();
}


if (
    !empty($_POST['product_description'])
) {

    $valid_extensions = ['png', 'jpg', 'jpeg', 'gif', 'zip', 'pdf', 'jfif'];
    $fileNames = array_filter($_FILES['file-to-upload']['name']);

    /*     var_dump($fileNames);
    echo '<br>';
    var_dump($_FILES['file-to-upload']['name']);
    exit; */

    /*     $test = $_FILES['file-to-upload']['tmp_name'];
    var_dump($test);
    echo '<br>';
    exit; */


    $images = [];
    foreach ($_FILES['file-to-upload']['tmp_name'] as $file) {

        $image_type = mime_content_type($file);
        $extension = strrchr($image_type, '/'); // /png ... /tmp ... /jpg
        $extension = ltrim($extension, '/'); // png ... jpg ... plain
        echo '<br>';
        if (!in_array($extension, $valid_extensions)) {
            echo "mmm.. hacking me?";
            exit();
        }
        $random_image_name = bin2hex(random_bytes(16)) . ".$extension";
        var_dump($file);
        echo '<br>';
        var_dump($random_image_name);

        array_push($images, $random_image_name);
        move_uploaded_file($file, "product-images/$random_image_name");
    };

    var_dump($images);

    $images = json_encode($images);





    /*     $image_type = mime_content_type($_FILES['file-to-upload']['tmp_name']); // image/png
    $extension = strrchr($image_type, '/'); // /png ... /tmp ... /jpg
    $extension = ltrim($extension, '/'); // png ... jpg ... plain

    if (!in_array($extension, $valid_extensions)) {
        echo "mmm.. hacking me?";
        exit();
    }

    $random_image_name = bin2hex(random_bytes(16)) . ".$extension";
   move_uploaded_file($_FILES['file-to-upload']['tmp_name'], "product-images/$random_image_name"); */

    //DATABASE

    $tz = 'Europe/Copenhagen';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
    $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
    $currentDate = $dt->format('F j Y, H:i:s');

    try {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/db/globals.php');
        $encryptedDescription = openssl_encrypt($_POST['product_description'], $encrypt_algo, $key, OPENSSL_RAW_DATA, $iv);
        require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
        $q = $db->prepare("INSERT INTO `products` VALUES ( :product_id, :user_uuid, :product_title, :product_description, :product_image, :product_timestamp, :product_price, :product_category, :product_iv)");
        $q->bindValue(':product_id', bin2hex(random_bytes(16)));
        $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
        $q->bindValue(':product_title', $_POST['product_title']);
        $q->bindValue(':product_description', $encryptedDescription);
        $q->bindValue(':product_image', $images);
        $q->bindValue(':product_timestamp', $currentDate);
        $q->bindValue(':product_price', $_POST['product_price']);
        $q->bindValue(':product_category', $_POST['product_category']);
        $q->bindValue(':product_iv',  base64_encode($iv));
        $q->execute();
        if (!$q->rowCount()) {
            echo 'vi er her', $_SESSION['user_uuid'];

            exit;
        }
        header('Location: /index');
        exit();
    } catch (PDOException $ex) {
        echo $ex;
    }
} else {
    header('Location: /index');
    exit();
}
