<?php

$this->title = 'Brandurile noastre - United Vision';

$this->params['meta_description'] = $this->title;
$this->params['meta_keywords'] = 'furla, gucci, ray ben, dolce gabana, anna hickman';

$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description']]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords']]);
$this->registerMetaTag(['name' => 'og:description', 'content' =>  $this->params['meta_description']]);
$this->registerMetaTag(['name' => 'og:title', 'content' =>  $this->params['meta_description']]);
?>
<!-- page image section -->

<?= $this->render('/commons/page-image', [
    'image' => 'https://www.chashmay.com.pk/images/blogs/blog-image-68.jpg',
    'pageName' => 'Brandurile noastre'
]) ?>

<!-- brand list section -->

<?= $this->render('components/brand-list.php', [
    'brandsProvider' => $brandsProvider,
    'urlCreator' => $urlCreator
]) ?>