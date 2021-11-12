<?php

try {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');
    $q = $db->prepare("SELECT * FROM replies 
                        INNER JOIN users
                        ON users.user_uuid = replies.user_uuid
                        ORDER BY created_at DESC
                        ");
    $q->execute();
    $replies = $q->fetchAll();
    foreach ($replies as $reply) {
    $replyMsg = out(openssl_decrypt(base64_decode($reply['reply_body']), $encrypt_algo, $key, OPENSSL_RAW_DATA, base64_decode($reply['reply_iv'])));
    }
} catch (PDOException $ex) {
    echo $ex;
}
