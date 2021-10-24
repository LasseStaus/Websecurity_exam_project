<?php

$peberstring = "/7GM8MrHGtusdj05ANPKzZQOBfkNPYf+LXVViYmmzjVIk0d+ATKHzf9vqRKmb+kFMYA=";
$algo = "sha256";

$encrypt_algo = "aes-256-cbc";



$key = "megafedkey"; // some language needs a key of a surtain length


$iv_len = openssl_cipher_iv_length($encrypt_algo);
$iv = openssl_random_pseudo_bytes($iv_len); //The length is depended on the alg, you can choose yourself




// $ciphertextIv= openssl_encrypt($plaintext, $alg_cbc, $key, OPENSSL_RAW_DATA, $iv ); // encrypt with the $iv // convert it to hex/base64encode

// echo base64_encode($ciphertextIv)."<br>";