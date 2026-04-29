<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\FileHelper;
?>
<!-- LOGO SLIDER START -->
<section class="swiper logo-slider" data-aos="fade-up" data-aos-once="true" data-aos-duration="1000">
    <div class="swiper-wrapper d-flex align-items-center">
        <?php if (!empty($brandsProvider) and $brandsProvider !== null) : ?>
            <?php foreach ($brandsProvider as $brand) : ?>
                <a href="<?= Url::toRoute([
                                'brand/details',
                                'id' => Html::encode($brand->id),
                                'name' => $urlCreator->createUrl(Html::encode($brand->name))
                            ]) ?>" class="swiper-slide logo-slider-slide">
                    <img src="<?= FileHelper::getFile([
                                    'filePath' => $brand->filePath,
                                    'file' => $brand->image_logo
                                ]) ?>" alt="<?= Html::encode($brand->name) ?>" />
                </a>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</section>
<!-- LOGO SLIDER END -->