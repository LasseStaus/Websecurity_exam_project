<?php
if (isset($success_message)) {
?>
    <div>
        <h3>
            Success!
        </h3>
        <p>
            <?= urldecode($success_message) ?>
        </p>
    </div>
<?php
}
?>