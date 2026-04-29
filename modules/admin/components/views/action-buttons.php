<?php

use yii\helpers\Html;

?>


<div class="action-buttons-area flex flex-row flex-wrap">
    <?php foreach ($buttons as $button) : ?>
        <?= Html::a($button['label'] . $button['icon'], $button['action'], $button['options']) ?>
    <?php endforeach ?>
</div>