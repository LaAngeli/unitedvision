<?php

use yii\helpers\Html;
use app\helpers\FileHelper;
// use app\helpers\Url;
?>
<?php if (!empty($servicesProvider) and $servicesProvider !== null) : ?>

    <?php foreach ($servicesProvider as $service => $item) : ?>


        <?php if ($service % 2 == 0) : ?>
            <section class="services-page">
                <div class="container">
                    <div class="services-page-wrapper d-flex flex-row justify-content-center align-items-start" data-aos="fade-down" data-aos-once="true" data-aos-duration="1000">
                        <div class="img-wrapper">
                            <img src="<?= FileHelper::getFile([
                                            'filePath' => $item->filePath,
                                            'file' => $item->image
                                        ]) ?>" loading="lazy" alt="<?= Html::encode($item->name) ?>" />
                        </div>
                        <div class="text-wrapper">
                            <h2><?= Html::encode($item->name) ?></h2>
                            <p>
                                <?= $item->description_max ?>
                            </p>
                            <div class="contact-btn-b contact-modal-open">
                                <button>Vreau detalii</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php else : ?>
            <section class="services-page">
                <div class="container">
                    <div class="services-page-wrapper rev d-flex flex-row justify-content-center align-items-start" data-aos="fade-up" data-aos-once="true" data-aos-duration="1000">
                        <div class="text-wrapper">
                            <h2><?= Html::encode($item->name) ?></h2>
                            <p>
                                <?= $item->description_max ?>
                            </p>
                            <div class="contact-btn-b contact-modal-open">
                                <button>Vreau detalii</button>
                            </div>
                        </div>
                        <div class="img-wrapper">
                            <img src="<?= FileHelper::getFile([
                                            'filePath' => $item->filePath,
                                            'file' => $item->image
                                        ]) ?>" loading="lazy" alt="<?= Html::encode($item->name) ?>" />
                        </div>
                    </div>
                </div>
            </section>
        <?php endif ?>

    <?php endforeach ?>

<?php endif ?>