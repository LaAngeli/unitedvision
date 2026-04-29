<?php

use yii\helpers\Html;

/** @var yii\web\View $this */

$siteName = $siteInfo->site_name ?? 'UnitedVision';
$metaDescription = $siteInfo->min_description ?? 'UnitedVision';

$this->title = Html::encode($siteName);
$this->params['meta_description'] = Html::encode($metaDescription);
$this->params['meta_keywords'] = 'Ochelari, furla, brand, glasses, rame, lentile, oftalmolog, vedere';

$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description']]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords']]);
$this->registerMetaTag(['name' => 'og:description', 'content' =>  $this->params['meta_description']]);
$this->registerMetaTag(['name' => 'og:title', 'content' =>  $this->params['meta_description']]);

?>
<!-- main slider section -->

<?= $this->render('components/main-slider.php', [
    'bannerProvider' => $bannerProvider,
    'urlCreator' => $urlCreator
]) ?>

<!-- services section -->

<?= $this->render('components/services.php') ?>

<!-- brands slider section -->

<?= $this->render('components/brands-slider.php', [
    'brandsProvider' => $brandsProvider,
    'urlCreator' => $urlCreator
]) ?>

<!-- counter section -->

<?= $this->render('components/counter.php') ?>


<!-- products section -->

<?= $this->render(
    'components/products.php',
    [
        'categoryProvider' => $categoryProvider,
        'urlCreator' => $urlCreator
    ]
) ?>


<!-- video-slider section -->

<?= $this->render('components/video-slider.php', [
    'brandsProvider' => $brandsProvider,
    'urlCreator' => $urlCreator
]) ?>


<!-- video-slider section -->

<?= $this->render('components/faq.php') ?>

<!-- logo-slider section -->

<?= $this->render('/commons/logo-slider.php', [
    'brandsProvider' => $brandsProvider,
    'urlCreator' => $urlCreator
]) ?>