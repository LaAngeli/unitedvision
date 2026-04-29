<?php
$this->title = 'Recenzii - United Vision';
$this->params['meta_description'] = $this->title;
$this->params['meta_keywords'] = 'Recenzii united vision';

$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description']]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords']]);
$this->registerMetaTag(['name' => 'og:description', 'content' =>  $this->params['meta_description']]);
$this->registerMetaTag(['name' => 'og:title', 'content' =>  $this->params['meta_description']]);

?>
<!-- page image section -->

<?= $this->render('/commons/page-image', [
    'image' => 'https://s.yimg.com/uu/api/res/1.2/cEYVh_2pgM3mzHnSgHV4Yw--~B/aD0xMTgyO3c9MTg3ODthcHBpZD15dGFjaHlvbg--/https://media-mbst-pub-ue1.s3.amazonaws.com/creatr-uploaded-images/2021-04/1c52b790-a6b0-11eb-b1df-159c6563325e.cf.jpg',
    'pageName' => "Parteneri"
]) ?>


<!-- page image section -->

<?= $this->render('components/reviews', [
    'reviewsProvider' => $reviewsProvider,
]) ?>


<!-- page image section -->

<?= $this->render('/commons/logo-slider') ?>