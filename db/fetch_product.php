

<?php



try {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
    $q = $db->prepare("SELECT * FROM products WHERE product_id = '$product_id'");
    $q->execute();
    $product = $q->fetch();
} catch (PDOException $ex) {
    echo $ex;
}
