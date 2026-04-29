<?php

$this->title = 'Despre noi - United Vision Moldova cei mai mari importatori oficiali de ochelari de brand din Republica Moldova ';

$this->params['meta_description'] = $this->title;
$this->params['meta_keywords'] = 'experienta, bradnuri, ochelari, rame, soare, protectie, rame, luxury, clienti';

$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description']]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords']]);
$this->registerMetaTag(['name' => 'og:description', 'content' =>  $this->params['meta_description']]);
$this->registerMetaTag(['name' => 'og:title', 'content' =>  $this->params['meta_description']]);

?>

<!-- brand single section -->

<?= $this->render('components/about.php', [
    'aboutProvider' => $aboutProvider
]) ?>