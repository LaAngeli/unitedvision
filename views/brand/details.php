<?php

use yii\helpers\Html;

$this->title = $model->name;


$this->params['meta_description'] = $model->description_min;
$this->params['meta_keywords'] = $this->title;

$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description']]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords']]);
$this->registerMetaTag(['name' => 'og:description', 'content' =>  $this->params['meta_description']]);
$this->registerMetaTag(['name' => 'og:title', 'content' =>  $this->title]);

?>

<!-- brand single section -->

<?= $this->render(
    'components/brand-single.php',
    [
        'model' => $model,
        'producerCategory' => $producerCategory,
    ]
) ?>

<!-- logo-slider section -->

<?= $this->render('/commons/logo-slider.php', [
    'brandsProvider' => $brandsProvider,
    'urlCreator' => $urlCreator
]) ?>