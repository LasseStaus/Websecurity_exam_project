<div class="product-imgs">
    <?php
    foreach ($image as $index => $item) {
        if ($index == 0) {
            // first
    ?>
            <div class="img-display">
                <div class="img-showcase">
                    <img src="../product-images/<?= out($item) ?>" alt="product image">
                </div>
            </div>
        <?php
        }
    }
    foreach ($image as $index => $item) {
        // other
        ?>
        <div class="img-select">
            <div class="img-item">
                <a href="#" data-id="1">
                    <img src="../product-images/<?= out($item) ?>" alt="product image">
                </a>
            </div>
        </div>
    <?php
    }
    ?>
    <?php


    ?>
</div>