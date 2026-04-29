<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\FileHelper;
?>

<div class="brands-page">
    <div class="container">
        <div class="brands-page-wrapper d-flex flex-row flex-wrap align-items-stretch justify-content-center" data-aos="fade-up" data-aos-once="true" data-aos-duration="1000">
            <?php if (!empty($brandsProvider) and $brandsProvider !== null) : ?>
                <?php foreach ($brandsProvider as $brand) : ?>
                    <a href="<?= Url::toRoute([
                                    'brand/details',
                                    'id' => Html::encode($brand->id),
                                    'name' => $urlCreator->createUrl(Html::encode($brand->name))
                                ]) ?>" class="brand-wrapper"><img src="<?= FileHelper::getFile([
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
    </div>
</div>