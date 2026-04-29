<?php

use yii\helpers\Html;
use app\helpers\FileHelper;
// use app\helpers\Url;
?>
<?php if (!empty($reviewsProvider) and $reviewsProvider !== null) : ?>

    <?php foreach ($reviewsProvider as $review => $item) : ?>


        <?php if ($review % 2 == 0) : ?>
            <section class="services-page">
                <div class="container">
                    <div class="services-page-wrapper d-flex flex-row justify-content-center align-items-start" data-aos="fade-down" data-aos-once="true" data-aos-duration="1000">
                        <div class="img-wrapper">
                            <img src="<?= FileHelper::getFile([
                                            'filePath' => $item->filePath,
                                            'file' => $item->image
                                        ]) ?>" loading="lazy" alt="<?= Html::encode($item->initials) ?>" />
                        </div>
                        <div class="text-wrapper">
                            <h2><?= Html::encode($item->initials) ?></h2>
                            <p>
                                <?= $item->review ?>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        <?php else : ?>
            <section class="services-page">
                <div class="container">
                    <div class="services-page-wrapper rev d-flex flex-row justify-content-center align-items-start" data-aos="fade-up" data-aos-once="true" data-aos-duration="1000">
                        <div class="text-wrapper">
                            <h2><?= Html::encode($item->initials) ?></h2>
                            <p>
                                <?= $item->review ?>
                            </p>
                        </div>
                        <div class="img-wrapper">
                            <img src="<?= FileHelper::getFile([
                                            'filePath' => $item->filePath,
                                            'file' => $item->image
                                        ]) ?>" loading="lazy" alt="<?= Html::encode($item->initials) ?>" />
                        </div>
                    </div>
                </div>
            </section>
        <?php endif ?>

    <?php endforeach ?>

<?php endif ?>