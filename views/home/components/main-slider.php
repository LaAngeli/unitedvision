<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\FileHelper;
?>

<!-- INTRO SLIDER START -->
<section class="swiper intro-slider desktop">
    <div class="swiper-wrapper">

        <?php if (!empty($bannerProvider) and $bannerProvider !== null) : ?>

            <?php foreach ($bannerProvider as $item) : ?>

                <a <?php if ($item->url === null or empty($item->url)) : ?> <?php else : ?> href="<?= Html::encode($item->url) ?>" <?php endif ?> class="swiper-slide intro-slider-slide">
                    <img src="<?= FileHelper::getFile([
                                    'filePath' => $item->filePath,
                                    'file' => $item->image_desktop
                                ]) ?>" alt="<?= Html::encode($item->name) ?>" />
                </a>


            <?php endforeach ?>

        <?php endif ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
</section>

<section class="swiper intro-slider mobile">
    <div class="swiper-wrapper">
        <?php if (!empty($bannerProvider) and $bannerProvider !== null) : ?>

            <?php foreach ($bannerProvider as $item) : ?>
                <a <?php if ($item->url === null or empty($item->url)) : ?> <?php else : ?> href="<?= Html::encode($item->url) ?>" <?php endif ?> class="swiper-slide intro-slider-slide-m">
                    <img src="<?= FileHelper::getFile([
                                    'filePath' => $item->filePath,
                                    'file' => $item->image_mobile
                                ]) ?>" alt="<?= Html::encode($item->name) ?>" />
                </a>
            <?php endforeach ?>

        <?php endif ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
</section>
<!-- INSTRO SLIDER END -->