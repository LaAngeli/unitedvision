<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\FileHelper;

?>
<?php
$siteName = $siteInfo->site_name ?? 'UnitedVision';
$logoFooter = ($siteInfo && $siteInfo->logo_footer)
    ? FileHelper::getFile([
        'file' => $siteInfo->logo_footer,
        'filePath' => $siteInfo->filePath,
    ])
    : Yii::getAlias('@web/favicon.ico');
$mapLocation = $siteInfo->map_location ?? '';
?>
<footer class="footer">
    <div class="container">
        <div class="wrapper d-flex flex-column align-items-center">
            <a href="" class="footer-logo">
                <img src="<?= $logoFooter ?>" alt="<?= Html::encode($siteName) ?>" alt="" />
            </a>

            <p>
                <?= Html::encode($text) ?>
            </p>
            <div class="footer-text-wrapper d-flex flex-row justify-content-around">
                <ul class="contacts d-flex flex-column">
                    <?php foreach ($contacts as $contact => $item) : ?>
                        <li>
                            <?= Html::a($item['name'], null, ['href' => $item['href'], $item['options']]) ?>;
                        </li>
                    <?php endforeach ?>
                </ul>
                <div class="map">
                    <iframe src="<?= Html::encode($mapLocation) ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <ul class="links">
                    <?php foreach ($links as $link => $item) : ?>
                        <li>
                            <a href="<?= Url::toRoute($item['url']) ?>"><span class="material-symbols-outlined">
                                    chevron_right </span><?= $item['name'] ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
            <div class="socials">
                <a target="_blank" href="https://www.facebook.com/unitedvisionmoldova"><i class="bi bi-facebook"></i></a>
                <a target="_blank" href="https://www.instagram.com/unitedvision.md/"><i class="bi bi-instagram"></i></a>
                <a target="_blank" href="https://twitter.com/unitedvisionmd"><i class="bi bi-twitter"></i></a>
                <a target="_blank" href="https://www.linkedin.com/company/united-vision-moldova/"><i class="bi bi-linkedin"></i></a>
            </div>
            <h5>
                Unitedvision Moldova © <?= date("Y"); ?>. Toate drepturile rezervate.
            </h5>
        </div>
    </div>
</footer>