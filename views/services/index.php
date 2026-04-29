<?php
$this->title = 'Serviciile noastre - United Vision';
$this->params['meta_description'] = $this->title;
$this->params['meta_keywords'] = 'Servicii Montare lentile, echipament monetare lentile, servicii reparare ochelari ';

$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description']]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords']]);
$this->registerMetaTag(['name' => 'og:description', 'content' =>  $this->params['meta_description']]);
$this->registerMetaTag(['name' => 'og:title', 'content' =>  $this->params['meta_description']]);

?>
<!-- page image section -->

<?= $this->render('/commons/page-image', [
    'image' => 'https://www.opticas.ro/img/carousel/servicii-opticas/opticas-montaj-lentile-ochelari-vedere.jpg',
    'pageName' => "Serviciile noastre"
]) ?>


<!-- page image section -->

<?= $this->render('components/services', [
    'servicesProvider' => $servicesProvider,
]) ?>


<!-- page image section -->

<?= $this->render('/commons/logo-slider') ?>