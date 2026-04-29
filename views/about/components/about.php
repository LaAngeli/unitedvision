<?php

use yii\helpers\Html;
use app\helpers\FileHelper;

?>
<?php if (!empty($aboutProvider) and $aboutProvider !== null) : ?>
    <?php foreach ($aboutProvider as $about) : ?>
        <div class="paralax d-flex align-items-center justify-content-center" style="background-image: url(<?= FileHelper::getFile([
                                                                                                                'filePath' => $about->filePath,
                                                                                                                'file' => $about->image
                                                                                                            ]) ?>)">
            <div class="info d-flex align-items-center" data-aos="fade-down" data-aos-once="true" data-aos-duration="1000">
                <div class="text-wrapper d-flex flex-column align-items-center">
                    <h4>UNITEDVISION</h4>
                    <h2><?= Html::encode($about->name) ?></h2>
                    <p>
                        <?= $about->description_max ?>
                    </p>
                    <div class="contact-btn-b contact-modal-open">
                        <button>Sună acum!</button>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach ?>
<?php endif ?>