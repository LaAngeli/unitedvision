<?php

use yii\helpers\Html;

?>
<div class="modal-video-slider-wrapper d-flex align-items-center justify-content-center vd-wr">
    <span class="material-symbols-outlined close-md">
        close
    </span>
    <div class="modal-slider d-flex align-items-center justify-content-center">
        <section class="swiper modal-video-slider">
            <div class="swiper-wrapper">
                <?php if (!empty($brandsProvider) and $brandsProvider !== null) : ?>
                    <?php foreach ($brandsProvider as $brand) : ?>
                        <div class="swiper-slide vd-sl">
                            <iframe src="<?= Html::encode($brand->video_url) ?>?rel=0&enablejsapi=1&rel=0&modestbranding=1&showinfo=0" title="YouTube video player" frameborder="0" showinfo="0" allowscriptaccess="always" frameborder="0" allowfullscreen></iframe>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
            <div class="swiper-button-next sl-nv"></div>
            <div class="swiper-button-prev sl-nv"></div>
        </section>
    </div>
</div>