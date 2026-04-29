<?php
$this->title = 'Produsele noastre - United vision';
$this->params['meta_description'] = $this->title;
$this->params['meta_keywords'] = 'Ochelari de soare, lentile de contact, lentile de coretie, roame pentru ochelari';

$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description']]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords']]);
$this->registerMetaTag(['name' => 'og:description', 'content' =>  $this->params['meta_description']]);
$this->registerMetaTag(['name' => 'og:title', 'content' =>  $this->params['meta_description']]);
?>

<!-- page image section -->

<?= $this->render('/commons/page-image', [
    'image' => 'https://wallpaperaccess.com/full/5863410.jpg',
    'pageName' => 'Produsele noastre'
]) ?>

<!-- product list section -->

<?= $this->render('components/product-list', [
    'categoryProvider' => $categoryProvider,
    'urlCreator' => $urlCreator
]) ?>