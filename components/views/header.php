<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\FileHelper;


?>
<?php
$phone = $siteInfo->phone_number ?? '';
$email = $siteInfo->email ?? '';
$siteName = $siteInfo->site_name ?? 'UnitedVision';
$logoHeader = ($siteInfo && $siteInfo->logo_header)
    ? FileHelper::getFile([
        'file' => $siteInfo->logo_header,
        'filePath' => $siteInfo->filePath,
    ])
    : Yii::getAlias('@web/favicon.ico');
?>

<!-- HEADER START -->
<header class="header">
    <!-- PRE HEADER START -->
    <div class="pre-header">
        <div class="container">
            <div class="pre-nav d-flex flex-row align-items-center justify-content-between">
                <div class="contacts d-flex flex-row">
                    <a href="tel:<?= Html::encode($phone) ?>"><i class="bi bi-telephone-fill"></i><?= Html::encode($phone) ?></a>
                    <a href="mailto:<?= Html::encode($email) ?>"><i class="bi bi-envelope-fill"></i>
                        <?= Html::encode($email) ?></a>
                </div>
                <div class="socials">
                    <a target="_blank" href="https://www.facebook.com/unitedvisionmoldova"><i class="bi bi-facebook"></i></a>
                    <a target="_blank" href="https://www.instagram.com/unitedvision.md/"><i class="bi bi-instagram"></i></a>
                    <a target="_blank" href="https://twitter.com/unitedvisionmd"><i class="bi bi-twitter"></i></a>
                    <a target="_blank" href="https://www.linkedin.com/company/united-vision-moldova/"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- PRE HEADER END -->
    <div class="container">
        <!-- NAVIGATION START -->
        <nav class="nav d-flex flex-row align-items-center justify-content-between">
            <a href="/" class="header-logo"><img src="<?= $logoHeader ?>" alt="<?= Html::encode($siteName) ?>" /></a>

            <ul class="nav-links d-flex flex-row align-items-center">

                <?php foreach ($url as $link => $item) : ?>
                    <li><a href="<?= Url::toRoute($item['url']) ?>"><?= Html::encode($item['name']) ?></a></li>
                <?php endforeach ?>
                <li class="contact-btn contact-modal-open">
                    <button>Contact</button>
                </li>

                <li class="mob-vers-cont"> <a href="tel:<?= Html::encode($phone) ?>"><i class="bi bi-telephone-fill"></i><?= Html::encode($phone) ?></a></li>

                <li class='mob-vers-cont'><a href="mailto:<?= Html::encode($email) ?>"><i class="bi bi-envelope-fill"></i>
                        <?= Html::encode($email) ?></a></li>

                <div class="socials">
                    <a target="_blank" href="https://www.facebook.com/unitedvisionmoldova"><i class="bi bi-facebook"></i></a>
                    <a target="_blank" href="https://www.instagram.com/unitedvision.md/"><i class="bi bi-instagram"></i></a>
                    <a target="_blank" href="https://twitter.com/unitedvisionmd"><i class="bi bi-twitter"></i></a>
                    <a target="_blank" href="https://www.linkedin.com/company/united-vision-moldova/"><i class="bi bi-linkedin"></i></a>
                </div>
            </ul>
            <div class="menu-icon">
                <span></span>
            </div>
        </nav>
        <!-- NAVIGATION END -->
    </div>
</header>
<!-- HEADER END -->