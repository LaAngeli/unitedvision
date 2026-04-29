<?php

use yii\helpers\Html;
use app\helpers\FileHelper;
?>

<!-- VIDEO SLIDERS SECTION START -->

<div class="video" data-aos="fade-down" data-aos-once="true" data-aos-duration="1000">
    <div class="sec-header d-flex flex-column align-items-center align-self-center">
        <h3 class="text-center">UNITEDVISION</h3>
        <h2 class="text-center">Prezentări Video</h2>
    </div>
    <section class="swiper video-slider">
        <div class="swiper-wrapper">
            <?php if (!empty($brandsProvider) and $brandsProvider !== null) : ?>
                <?php foreach ($brandsProvider as $brand => $item) : ?>
                    <div class="swiper-slide video-slider-slide" data-index="<?= $brand + 1 ?>">
                        <img src="<?= FileHelper::getFile([
                                        'filePath' => $item->filePath,
                                        'file' => $item->image_video_preview
                                    ]) ?>" alt="<?= Html::encode($item->name) ?>" />
                        <span class="material-symbols-outlined">
                            play_circle
                        </span>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </section>
</div>

<?= $this->render('modal-video-slider', [
    'brandsProvider' => $brandsProvider
]) ?>



<!-- VIDEO SLIDER SECTION END -->