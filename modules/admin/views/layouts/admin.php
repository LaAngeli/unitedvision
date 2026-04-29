<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AdminAsset;
use yii\helpers\Html;
use app\modules\admin\components\AsideWidget as Aside;
use app\modules\admin\components\HeaderWidget as Header;

AdminAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>



    <div class="wrapper d-flex flex-row">

        <?= Aside::widget() ?>
        <div class="main-content d-flex flex-column">
            <?= Header::widget() ?>
            <main>
                <?= $content ?>
            </main>
        </div>
    </div>

    <div class="modal-photo-wrapper d-flex align-items-center justify-content-center">
        <span class="material-symbols-outlined close-modal-photo">
            close
        </span>
        <div class="modal-window">
            <img src="" alt="">
        </div>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>