<?php

use yii\helpers\Html;
?>

<section class="page-image">
    <img src="<?= $image ?>" alt="<?= Html::encode($pageName) ?>" />
    <div class="page-title d-flex align-items-center justify-content-center">
        <h2><?= Html::encode($pageName) ?></h2>
    </div>
</section>