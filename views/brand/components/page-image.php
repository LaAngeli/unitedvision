<?php 
use yii\helpers\Html;
use app\helpers\FileHelper;
?>
<section class="page-image">
    <img src="<?= FileHelper::getFile([
                                    'filePath' => $categoryBrand->filePath,
                                    'file' => $categoryBrand->image
                                ]) ?>" alt="<?= Html::encode($categoryBrand->name) ?>" />
    <div class="page-title d-flex align-items-center justify-content-center">
        <h2><?= Html::encode($categoryBrand->name) ?></h2>
    </div>
</section>