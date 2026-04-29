<?php

use app\modules\admin\components\BreadcrumbsWidget;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\producer\Producer $model */

$this->title = 'Adaugă brand';
?>
<div class="grid-wrapper">
    <?= BreadcrumbsWidget::widget([
        'links' =>
        [
            [
                'label' => 'Acasă',
                'url' => '/admin',
            ],
            [
                'label' => 'Brand-uri',
                'url' => '/admin/producer'
            ],
            [
                'label' => $this->title,
            ],
        ]
    ])
    ?>
</div>

<div class="form-wrapper d-flex flex-column">
    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'addForm' => $addForm,
        'brandNot' => $brandNot
    ]) ?>

</div>