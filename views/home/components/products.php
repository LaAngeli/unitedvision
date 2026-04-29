<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\FileHelper;


?>
<!-- PRODUCT SECTION START -->
<section class="product d-flex flex-column" data-aos="fade-up" data-aos-once="true" data-aos-duration="1000">
    <div class="sec-header d-flex flex-column align-items-center align-self-center">
        <h3 class="text-center">UNITEDVISION</h3>
        <h2 class="text-center">Produse</h2>
    </div>
    <div class="container">
        <div class="masonry">
            <?php if (!empty($categoryProvider) and $categoryProvider !== null) : ?>

                <?php foreach ($categoryProvider as $category) : ?>
                    <a href="<?= Url::toRoute(['/brand/category', 'category_id' => $category->id, 'name' => $urlCreator->createUrl($category->name)]) ?>" class="item">
                        <img src="<?= FileHelper::getFile(['filePath' => $category->filePath, 'file' => $category->image]) ?>" />
                        <div class="content-details fadeIn-left d-flex align-items-center justify-content-center">
                            <h4><?= Html::encode($category->name) ?></h4>
                        </div>
                    </a>
                <?php endforeach ?>

            <?php endif ?>

        </div>
    </div>
</section>
<!-- PRODUCT SECTION END -->