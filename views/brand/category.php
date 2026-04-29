<?php

use app\helpers\FileHelper;
use yii\helpers\Html;

$this->title = 'Braduri ' . Html::encode($categoryBrand->name) . ' - United vision';

$this->params['meta_description'] = $this->title;
$this->params['meta_keywords'] = Html::encode($categoryBrand->name);

$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description']]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords']]);
$this->registerMetaTag(['name' => 'og:description', 'content' =>  $this->params['meta_description']]);
$this->registerMetaTag(['name' => 'og:title', 'content' =>  $this->params['meta_description']]);
?>
<!-- page image section -->

<?= $this->render('/commons/page-image', [
    'image' =>  FileHelper::getFile([
        'filePath' => $categoryBrand->filePath,
        'file' => $categoryBrand->image
    ]),
    'pageName' => Html::encode($categoryBrand->name)
]) ?>

<!-- brand list section -->

<?= $this->render('components/brand-list', [
    'brandsProvider' => $brandsProvider,
    'urlCreator' => $urlCreator
]) ?>