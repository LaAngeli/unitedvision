<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\FileHelper;
?>
<!-- BRAND SECTION START -->
<section class="brands" data-aos="fade-up" data-aos-once="true" data-aos-duration="1000">
    <!-- <div class="container"> -->
    <div class="sec-wrapper d-flex flex-column">
        <div class="sec-header d-flex flex-column align-items-center align-self-center">
            <h3 class="text-center">UNITEDVISION</h3>
            <h2 class="text-center">Banduri</h2>
        </div>
        <div class="slider-br-wrapper">
            <div class="swiper brands-slider">
                <div class="swiper-wrapper">
                    <?php if (!empty($brandsProvider) and $brandsProvider !== null) : ?>

                        <?php foreach ($brandsProvider as $brand) : ?>
                            <a href="<?= Url::toRoute([
                                            'brand/details',
                                            'id' => Html::encode($brand->id),
                                            'name' => $urlCreator->createUrl(Html::encode($brand->name))
                                        ]) ?>" class="swiper-slide br-slide"><img src="<?= FileHelper::getFile([
                                                                                            'filePath' => $brand->filePath,
                                                                                            'file' => $brand->image_brand
                                                                                        ]) ?>" alt="<?= Html::encode($brand->name) ?>" />
                                <div class="hv d-flex align-items-center justify-content-center">
                                    <button>DETALII</button>
                                </div>
                            </a>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
                <div class="swiper-br-nav d-flex flex-row">
                    <span class="material-symbols-outlined br-back">
                        arrow_back_ios
                    </span>
                    <span class="material-symbols-outlined br-next">
                        arrow_forward_ios
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
</section>
<!-- BRAND SECTION END -->