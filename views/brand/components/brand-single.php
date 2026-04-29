<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\FileHelper;

?>
<section class="brand-page" data-aos="fade-up" data-aos-once="true" data-aos-duration="1000">
    <div class="container">
        <div class="brand-page-wrapper d-flex flex-column align-items-center">
            <div class="brand-info d-flex flex-row justify-content-center align-items-start">
                <div class="img-wrapper play-video-modal">
                    <img src="<?= FileHelper::getFile([
                                    'filePath' => $model->filePath,
                                    'file' => $model->image_brand
                                ]) ?>" alt="<?= Html::encode($model->name) ?>" />
                    <span class="material-symbols-outlined">
                        play_circle
                    </span>
                </div>
                <div class="text-wrapper">
                    <img src="<?= FileHelper::getFile([
                                    'filePath' => $model->filePath,
                                    'file' => $model->image_logo
                                ]) ?>" alt="<?= Html::encode($model->name) ?>" class="logo-brand" />
                    <p>
                        <?= $model->description_max ?>

                    <div class="contact-btn-b contact-modal-open">
                        <button>Vreau detalii</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="category-product-brand-btns d-flex flex-row align-items-center justify-content-center flex-wrap" data-aos="fade-down" data-aos-once="true" data-aos-duration="1000">

    <?php if (!empty($producerCategory) and $producerCategory !== null) : ?>
        <?php foreach ($producerCategory as $category) : ?>
            <button class="contact-modal-open"><?= Html::encode($category->name) ?></button>
        <?php endforeach ?>
    <?php endif ?>
</div>

<?= $this->render('modal-video', ['model' => $model]) ?>