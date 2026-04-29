<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use app\components\HeaderWidget;
use app\components\FooterWidget;
use app\components\ContactModalWidget;
use app\helpers\FileHelper;
use app\models\site\SiteInfo;

$siteInfo = SiteInfo::find()->one();
$siteName = $siteInfo->site_name ?? 'UnitedVision';
$sitePhone = $siteInfo->phone_number ?? '';
$siteEmail = $siteInfo->email ?? '';
$siteAddress = $siteInfo->address ?? '';
$siteFooterText = $siteInfo->footer_text ?? 'UnitedVision';
$siteImage = ($siteInfo && $siteInfo->site_image)
    ? FileHelper::getFile(['file' => $siteInfo->site_image, 'filePath' => $siteInfo->filePath])
    : Yii::getAlias('@web/favicon.ico');

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
$this->registerMetaTag(['name' => 'og:url', 'content' => 'https://unitedvision.md' . Url::Current()]);
$this->registerMetaTag(['name' => 'og:locale', 'content' =>  'ro_RO']);
$this->registerMetaTag(['name' => 'og:image', 'content' =>  $siteImage]);
$this->registerMetaTag(['name' => 'og:type', 'content' =>  'website']);
$this->registerMetaTag(['name' => 'og:site_name', 'content' => Html::encode($siteName)]);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <div class="site-wrapper">

        <?= HeaderWidget::widget([
            'url' =>
            [
                [
                    'url' => '/',
                    'name' => 'Acasă'
                ],
                [
                    'url' => '/about',
                    'name' => 'Despre noi'
                ],
                [
                    'url' => '/services',
                    'name' => 'Servicii'
                ],
                [
                    'url' => '/product',
                    'name' => 'Produse'
                ],
                [
                    'url' => '/brand',
                    'name' => 'Branduri'
                ],
                [
                    'url' => '/reviews',
                    'name' => 'Parteneri'
                ],

            ]
        ]) ?>


        <main>
            <?= $content ?>
        </main>

        <?= FooterWidget::widget([
            'contacts' => [
                [
                    'name' => '<span class="material-symbols-outlined">phone_in_talk </span>' . $sitePhone,
                    'href' => 'tel:' . $sitePhone,
                    'options' => null
                ],
                [
                    'name' => '<span class="material-symbols-outlined">alternate_email </span>' . $siteEmail,
                    'href' => 'mailto:' . $siteEmail,
                    'options' => null
                ],
                [
                    'name' => '<span class="material-symbols-outlined">location_on </span>' . $siteAddress,
                    'href' => 'https://goo.gl/maps/fixTvoSumxfztqAV7',
                    'options' => null
                ],
            ],
            'links' => [
                [
                    'url' => '/',
                    'name' => 'Acasă'
                ],
                [
                    'url' => '/about',
                    'name' => 'Despre noi'
                ],
                [
                    'url' => '/services',
                    'name' => 'Servicii'
                ],
                [
                    'url' => '/product',
                    'name' => 'Produse'
                ],
                [
                    'url' => '/brand',
                    'name' => 'Branduri'
                ],
                [
                    'url' => '/reviews',
                    'name' => 'Parteneri'
                ],
            ],
            'text' => $siteFooterText
        ]) ?>

    </div>

    <?= ContactModalWidget::widget([]) ?>


    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>